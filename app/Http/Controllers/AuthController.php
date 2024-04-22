<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request -> validate
        ([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if(auth('web')->attempt($data))
        {
            return redirect('/');
        }

        return redirect('/login')->withErrors(['email' => 'Email or password invalid']);
    }

    public function logout()
    {
        auth('web')->logout();

        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate
        ([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|between:8,255|confirmed'
        ]);

        $user = User::create
        ([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);

        if($user)
        {
            auth('web')->login($user);
        }

        return redirect('/');
    }
}
