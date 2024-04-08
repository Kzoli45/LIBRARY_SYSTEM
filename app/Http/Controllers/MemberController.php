<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Lending;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\OtherMember;
use Illuminate\Http\Request;
use App\Models\ForeignMember;
use App\Models\LibraryMember;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::where('deleted', 0)->filters($request->all())->latest()->get();

        return view('members.index', compact('members'));
    }

    public function showCreateForm()
    {
        return view('members.create');
    }

    public function storeNewMember(request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'postcode' => ['required', 'numeric'],
            'city' => 'required',
            'street' => 'required',
            'door' => ['required', 'numeric'],
            'contact' => ['required', 'email', Rule::unique('members', 'contact')],
            'type' => 'required'
        ]);

        Member::create($formFields);
        return redirect('/members');
    }

    public function show(Member $member)
    {
        return view('members.manage', [
            'member' => $member
        ]);
    }

    public function showEditForm(Member $member)
    {
        return view('members.edit', ['member' => $member]);
    }

    public function update(Request $request, Member $member)
    {
        $rules = [
            'name' => 'required',
            'postcode' => ['required', 'numeric'],
            'city' => 'required',
            'street' => 'required',
            'door' => ['required', 'numeric'],
            'contact' => ['required', 'email'],
            'type' => 'required'
        ];

        if ($request->contact !== $member->contact) {
            $rules['contact'] = ['required', 'email', Rule::unique('members', 'contact')];
        }

        $formFields = $request->validate($rules);

        $member->update($formFields);

        return redirect('/members/' . $member->id);
    }

    public function destroy(Member $member)
    {
        $member->update(['deleted' => 1]);

        return redirect('/members');
    }

    public function showAssign(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->takeable == 0) {
            return back()->with('error', 'This book is currently loaned out!');
        } else {
            $members = Member::where('deleted', 0)->filters($request->all())->latest()->get();

            return view('members.available', compact('members', 'bookId'));
        }
    }

    public function showAssignForm($bookId, $memberId)
    {
        $book = Book::findOrFail($bookId);
        $member = Member::findOrFail($memberId);

        $type = $member->type;

        switch ($type) {
            case 'student':
                $newMember = new Student();
                break;
            case 'teacher':
                $newMember = new Teacher();
                break;
            case 'foreign':
                $newMember = new ForeignMember();
                break;
            case 'other':
                $newMember = new OtherMember();
                break;
        }

        $memberLoanCount = Lending::where('member_id', $member->id)->where('is_active', 1)->count();
        if ($memberLoanCount >= $newMember->getMaxBooks()) {
            return back()->with('error', 'This member has exceeded their limit!');
        } else {
            return view('members.loan', compact('book', 'member'));
        }
    }

    public function store($book, $member, Request $request)
    {

        request()->validate([
            'startdate' => 'required'
        ]);

        $currentBook = Book::findOrFail($book);
        $currentMember = Member::findOrFail($member);

        $type = $currentMember->type;

        switch ($type) {
            case 'student':
                $newMember = new Student();
                break;
            case 'teacher':
                $newMember = new Teacher();
                break;
            case 'foreign':
                $newMember = new ForeignMember();
                break;
            case 'other':
                $newMember = new OtherMember();
                break;
        }

        $loanDuration = $newMember->getLoanDuration();
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('startdate'));
        $returnDate = $startDate->copy()->addDays($loanDuration);

        Lending::create([
            'book_id' => $book,
            'member_id' => $member,
            'taken_date' => $startDate,
            'return_date' => $returnDate
        ]);

        $currentBook->update(['takeable' => 0]);

        return redirect('/books');
    }

    public function showLendings()
    {
        $lendings = Lending::with('book', 'member')->latest()->get();

        return view('lendings.index', compact('lendings'));
    }

    public function showMemberLendings(Member $member)
    {
        $lendings = Lending::with('book', 'member')->where('member_id', $member->id)->latest()->get();

        if ($lendings->count() != 0) {
            return view('lendings.loanhistory', compact('lendings'));
        } else {
            return back()->with('error', 'This member has not loaned out any books yet!');
        }
    }

    public function showActive(Member $member)
    {
        $lendings = Lending::with('book', 'member')->where('is_active', 1)->where('member_id', $member->id)->latest()->get();

        return view('lendings.active', compact('lendings'));
    }

    public function showReturned(Member $member)
    {
        $lendings = Lending::with('book', 'member')->where('is_active', 0)->where('member_id', $member->id)->latest()->get();

        return view('lendings.returned', compact('lendings'));
    }

    public function putBack(Lending $lending)
    {
        $lending->update(['is_active' => 0]);

        $book = Book::findOrFail($lending->book_id);
        $book->update(['takeable' => 1]);

        $returnDate = Carbon::parse($lending->return_date);
        $currentDate = Carbon::now();

        $difference = $currentDate->diffInDays($returnDate);

        if ($currentDate > $returnDate) {
            return back()->with('error', 'This book was returned ' . $difference . ' day(s) late!');
        } else {
            return back()->with('message', 'This book was brought back in time!');
        }
    }
}
