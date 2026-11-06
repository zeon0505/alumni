<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
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
            'nim'      => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('alumni')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withInput($request->only('nim'))
            ->withErrors(['nim' => 'NIM atau password yang Anda masukkan salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('alumni')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showLupaPassword()
    {
        return view('auth.lupa-password');
    }

    public function lupaPassword(Request $request)
    {
        $request->validate([
            'nim'                  => ['required', 'string'],
            'tanggal_lahir'        => ['required', 'date'],
            'password'             => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $alumni = Alumni::where('nim', $request->nim)
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (! $alumni) {
            return back()
                ->withInput($request->only('nim', 'tanggal_lahir'))
                ->withErrors(['nim' => 'NIM dan tanggal lahir tidak cocok dengan data kami.']);
        }

        $alumni->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diperbarui. Silahkan login.');
    }
}
