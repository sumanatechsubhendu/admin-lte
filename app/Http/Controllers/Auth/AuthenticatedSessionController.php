<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        // if (Auth::user()->role->name == "Admin") {
        //     return redirect()->intended('/webpanel/users');
        // }
        if (!Auth::user()->status) {
            $role = Auth::user()->role->name;
            Auth::logout();

            // If you want to redirect the user after logout, you can do something like this:
            if (Auth::check() && Auth::user()->hasRole('Admin')) {
                return redirect('/login')->with('status', 'Account is inactive. Please contact support for assistance.');
            } else {
                return redirect()->intended('/webpanel/login')->with('status', 'Account is inactive. Please contact support for assistance.');
            }
        }

        if (Auth::check() && Auth::user()->hasRole('Admin') && $request->loginType== "Admin") {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if (Auth::check() && Auth::user()->hasRole('User') && $request->loginType== "User") {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            // Force logout for the currently authenticated user
            Auth::logout();

            // If you want to redirect the user after logout, you can do something like this:
            if (Auth::check() && Auth::user()->hasRole('Admin')) {
                return redirect('/login')->with('status', 'Invalid Email or Password.');
            } else {
                return redirect()->intended('/webpanel/login')->with('status', 'Invalid Email or Password.');
            }
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
