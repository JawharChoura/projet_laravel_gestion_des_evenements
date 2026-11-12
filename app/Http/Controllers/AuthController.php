<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'CJ_email' => 'required|email',
            'CJ_password' => 'required|min:6',
        ]);

        if (Auth::attempt(['CJ_email' => $credentials['CJ_email'], 'password' => $credentials['CJ_password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/events');
        }

        return back()->withErrors(['CJ_email' => 'Identifiants invalides.'])->onlyInput('CJ_email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'CJ_name' => 'required|string|max:255',
            'CJ_email' => 'required|email|unique:CJ_users',
            'CJ_password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'CJ_name' => $validated['CJ_name'],
            'CJ_email' => $validated['CJ_email'],
            'CJ_password' => Hash::make($validated['CJ_password']),
            'CJ_role' => 'user',
        ]);

        Auth::attempt(['CJ_email' => $validated['CJ_email'], 'password' => $validated['CJ_password']]);

        return redirect('/events')->with('success', 'Inscription réussie!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
