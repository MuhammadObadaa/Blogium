<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register() {
        return view('auth.register');
    }

    public function store() {
        $validated = request()->validate( [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]);

        $user = User::create($validated);

        return $user;
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate() {
        $validated = request()->validate( [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return auth()->user;
        }

    }

    public function logout() {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

}
