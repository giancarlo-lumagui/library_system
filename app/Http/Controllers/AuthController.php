<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('dashboard.dashboard');
    }

    public function login(Request $request){
        
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $role = Auth::user()->role;
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'name' => 'Invalid credentails'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
