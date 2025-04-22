<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm(){

        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('login-email'),
            'password' => $request->input('login-password'),
        ];

        if (auth('web')->attempt($credentials, $request->filled('remember'))) {
            if ($request->filled('remember')) {
                $minutes = 60 * 24 * 90; // 90 days

                // Save the email in a cookie
                Cookie::queue(cookie('email', $request->input('login-email'), $minutes));

                // Hash and save the password in a cookie
                Cookie::queue(cookie('password', $request->input('login-password'), $minutes));
            } else {
                // Remove cookies if "Remember Me" is not checked
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }

            return redirect()->intended('/admin/index');
        }

        return back()->withErrors([
            'login-email' => __('auth.failed'),
        ]);
    }




    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
