<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthenticationController extends Controller
{
    public function registerform()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ];

        $request->validate([
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8'
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            return Redirect::route('login');
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('/home');
        } else {

            return redirect()->back()->withInput()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function loginform()
    {
        return view('auth.login');
    }
}
