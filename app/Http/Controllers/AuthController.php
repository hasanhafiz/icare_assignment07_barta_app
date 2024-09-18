<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {
        // dd( $request );
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );

        $user->save();
        return back()->with('success', 'Registered successfully!');
    }

    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // $credentials = [
        //     'email' => $request->email,
        //     'password' => $request->password
        // ];

        if ( Auth::attempt( $credentials ) ) {
            return redirect('/home')->with('success', 'Logged in successfull!');
        }

        return back()->with('error', 'Email or Password is wrong!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
