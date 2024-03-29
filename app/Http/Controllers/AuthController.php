<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            
            $activityLog = new UserController;
            $activityLog->userAction(Auth::user()->id, 'User Logged In');
            
            return redirect()->intended('dashboard');
        }
        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request){
        $activityLog = new UserController;
        $activityLog->userAction(Auth::user()->id, 'User Logged Out');
        
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        

        return redirect('/');
    }
}
