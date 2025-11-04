<?php

// app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function showMembers() {
        return view('books.members');
    }

    public function register(Request $request) {
        $request->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'membership_date' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Member added successfully']);
    }

    public function show() {
        $members = Member::all();
        return response()->json(['success' => true, 'members' => $members]);
    }

public function update(Request $request, $id) {
    $member = Member::findOrFail($id);
    $member->update([
        'first_name' => $request->editFirstName,
        'last_name' => $request->editLastName,
        'email' => $request->editEmail,
        'phone' => $request->editPhone,
        'address' => $request->editAddress,
    ]);
    return response()->json(['success' => true, 'message' => 'Member updated successfully']);
}
    public function destroy($id) {
        $member = Member::findOrFail($id);
        $member->delete();
        return response()->json(['success' => true, 'message' => 'Member deleted successfully']);
    }
}
