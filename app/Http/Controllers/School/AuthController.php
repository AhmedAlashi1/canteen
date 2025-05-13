<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth('school')->check()) {
            return redirect()->route('school.dashboard');
        }

        return view('auth.login', ['prefix' => 'school']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login-email', 'login-password');
        $userType = $request->input('user_type'); // إما "admin" أو "school"

        // Validate the credentials
        $validator = Validator::make($credentials, [
            'login-email' => 'required|email',
            'login-password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
//        return $userType;

        // Attempt to log the user in

        $guard = ($userType == 'admin') ? 'admin' : 'school';
        $remember = $guard === 'admin' && $request->filled('remember'); // فقط لـ admin

        if (Auth::guard($guard)->attempt([
            'email' => $credentials['login-email'],
            'password' => $credentials['login-password']
        ], $remember)) {
            return redirect()->route($userType.'.dashboard'); // قم بتوجيهه إلى الصفحة المناسبة للمسؤول
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('school')->logout();
        return redirect()->route('school.login');

    }
}
