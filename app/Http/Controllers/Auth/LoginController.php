<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        // Angka ringkas untuk halaman informasi (aman bila database belum siap)
        try {
            $info = [
                'total' => \App\Models\Pengaduan::count(),
                'selesai' => \App\Models\Pengaduan::where('status', 'selesai')->count(),
                'teknisi' => \App\Models\User::where('role', 'teknisi')->count(),
            ];
        } catch (\Throwable $e) {
            $info = ['total' => 0, 'selesai' => 0, 'teknisi' => 0];
        }

        return view('auth.login', compact('info'));
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau kata sandi yang Anda masukkan salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return redirect()->intended(route($user->homeRoute()));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
