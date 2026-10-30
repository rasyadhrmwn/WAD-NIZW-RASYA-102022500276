<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman/form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses autentikasi/login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke halaman dashboard/topik_baru jika berhasil
            return redirect()->intended('/topik_baru')->with('success', 'Berhasil login!');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}