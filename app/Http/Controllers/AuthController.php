<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'HR') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'HR') {
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akses hanya untuk HR.',
                ]);
            }
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'HR') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
            }
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required',
            'role' => 'required|in:HR,Jobseeker',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);
        Auth::login($user);
        if ($user->role === 'HR') {
            return redirect('dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun berhasil dibuat, tapi hanya HR yang bisa login.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
