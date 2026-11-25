<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate login fields
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check email and password
        if (Auth::attempt($credentials)) {

            // Regenerate session for security
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect according to role
            if ($user->role == 'manager') {
                return redirect('/manager/dashboard');
            }

            if ($user->role == 'employee') {
                return redirect('/employee/dashboard');
            }

            Auth::logout();

            return redirect('/login')
                ->withErrors(['email' => 'Invalid user role.']);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
