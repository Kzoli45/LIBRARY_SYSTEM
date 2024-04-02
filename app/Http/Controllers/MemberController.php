<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
}
