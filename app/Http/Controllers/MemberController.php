<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Lending;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\LibraryMember;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ForeignMember;
use App\Models\OtherMember;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::filters($request->all())->latest()->get();

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
            'contact' => ['required', Rule::unique('members', 'contact')],
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
        $formFields = $request->validate([
            'name' => 'required',
            'postcode' => ['required', 'numeric'],
            'city' => 'required',
            'street' => 'required',
            'door' => ['required', 'numeric'],
            'contact' => 'required',
            'type' => 'required'
        ]);

        $member->update($formFields);

        return redirect('/members/' . $member->id);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect('/members');
    }

    public function showAssign(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->takeable == 0) {
            return back()->with('error', 'This book is currently loaned out!');
        } else {
            $members = Member::filters($request->all())->latest()->get();

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

        $memberLoanCount = Lending::where('member_id', $member->id)->where('is_active', true)->count();
        if ($memberLoanCount > $newMember->getMaxBooks()) {
            return back()->with('error', 'This member has exceeded their limit!');
        } else {
            return view('members.loan', compact('book', 'member'));
        }
    }
}
