<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    // Show Login

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {

        $username = $request->input('username');

        if (Cache::has('login_attempts_' . $username) && Cache::get('login_attempts_' . $username) >= 3) {
            $secondsToWait = 20;
            return back()->withErrors(['username' => 'Too many login attempts. Please try again in ' . $secondsToWait . ' seconds'])->onlyInput('username');
        }

        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {

            Cache::forget('login_attempts_' . $username);

            $request->session()->regenerate();

            return redirect('/')->with('message', 'Logged In!');
        } else {
            $attempts = Cache::get('login_attempts_' . $username, 0);
            $attempts++;
            Cache::put('login_attempts_' . $username, $attempts, now()->addMinutes(1));

            return back()->withErrors(['username' => 'Invalid credentials'])->onlyInput('username');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
}
