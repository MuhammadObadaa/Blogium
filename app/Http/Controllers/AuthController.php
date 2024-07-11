<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $validated = $request->validate( [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return $this->authenticate($request);

        /* this redirects to auth.login route
         * return redirect()
         *  ->route('auth.dashboard')
         *  ->with($request->only('emai','password'));
         */
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard');
        }

        $errors = (object)array('email' => ['invalid email or password']);

        return redirect()->back()->withErrors($errors);
    }

    public function logout() {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard');
    }

}
