<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        return view('admin.index');
    }

    public function login(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        return view('admin.login.login');
    }

    public function DoLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->remember)) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['errors' => 'ایمیل یا رمز عبور اشتباه است']);

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
