<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->department->department) {
                'trainers' => redirect()->route('trainers.index'),
                'members' => redirect()->route('members.index'),
                'branches' => redirect()->route('branches'),
                'warehouses' => redirect()->route('warehouses'),
                'classes' => redirect()->route('workouts'),

                // default => redirect()->route('dashboard'),
            };
        }

        return redirect()->route('login')->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request) : RedirectResponse
    {
        //auth()->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
