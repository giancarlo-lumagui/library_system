<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //
    public function showUsers(){
        return view('utilities.users');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:30',
            'role' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully'
        ]);
    }

    public function show(){
        $users = User::all();
        return response()->json([
            'success' => true,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'role' => $request->role
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully'
        ]);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

}
