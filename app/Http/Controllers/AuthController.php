<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt([
            'username' => $validated['username'],
            'password' => $validated['password']
        ])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with('invalid', 'Invalid credentials');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProcess(RegisterRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'USER',
        ];

        $user = User::create($data);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
