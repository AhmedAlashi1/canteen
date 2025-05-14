<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm(){
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login', ['prefix' => 'admin']);
    }


    public function login(Request $request)
    {

        // تحديد نوع المستخدم بناءً على المدخلات
        $userType = $request->input('user_type'); // إما "admin" أو "school"
        $credentials = $request->only('login-email', 'login-password');

        $validator = Validator::make($credentials, [
            'login-email' => 'required|email',
            'login-password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $guard = ($userType == 'admin') ? 'admin' : 'school';

        if (Auth::guard($guard)->attempt([
            'email' => $credentials['login-email'],
            'password' => $credentials['login-password']
        ], $request->filled('remember'))) {
            return redirect()->route($userType.'.dashboard'); // قم بتوجيهه إلى الصفحة المناسبة للمسؤول
        }

        // إذا فشل التحقق من البيانات
        return back()->withErrors([
            'login-email' => 'The provided credentials do not match our records.',
        ]);
    }




    public function logout(){
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
