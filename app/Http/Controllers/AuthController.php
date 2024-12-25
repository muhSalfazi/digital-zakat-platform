<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function index()
    {
        return view('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Jika user ditemukan, cek status
        if ($user) {
            if ($user->status == 'non-aktif') {
                return back()->withErrors([
                    'username' => 'Akun Anda dinonaktifkan. Silakan hubungi admin.',
                ]);
            }

            // Cek kredensial setelah memastikan status aktif
            if (Auth::attempt($request->only('username', 'password'))) {
                // Redirect sesuai role
                if ($user->role == 'admin' || $user->role == 'amil') {
                    return redirect()->route('dashboard');
                }
            } else {
                return back()->withErrors([
                    'username' => 'Kredensial ini tidak cocok dengan catatan kami.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Akun tidak ditemukan.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}