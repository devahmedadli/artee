<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function customerLogin()
    {
        // check if the user is already logged in
        if (Auth::check() && Auth::user()->role == 'customer') {
            return redirect()->intended('/');
        }
        if (Auth::check() && Auth::user()->role == 'freelancer') {
            return redirect()->intended('freelancer/dashboard');
        }
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->intended('admin/dashboard');
        }

        return view('auth.customer.login');
    }

    public function cpanelLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->role === 'freelancer') {
                return redirect()->intended('freelancer/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->role === 'freelancer') {
                return redirect()->intended('freelancer/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // get the user role
        $user               = Auth::user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($user->role === 'admin') {
            return redirect()->route('cpanel.login');
        } elseif ($user->role === 'freelancer') {
            return redirect()->route('cpanel.login');
        } else {
            return redirect()->route('login');
        }
        return redirect('/');
    }
}
