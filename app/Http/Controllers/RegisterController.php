<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nim'          => ['required', 'string', 'max:30', 'unique:alumni,nim'],
            'name'         => ['required', 'string', 'max:255'],
            'email_pribadi'=> ['required', 'email', 'max:255'],
            'password'     => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nim.unique'          => 'NIM sudah terdaftar. Silahkan login atau hubungi admin.',
            'email_pribadi.email' => 'Format email tidak valid.',
        ]);

        $alumni = Alumni::create([
            'nim'           => $validated['nim'],
            'name'          => $validated['name'],
            'email_pribadi' => $validated['email_pribadi'],
            'password'      => Hash::make($validated['password']),
        ]);

        Auth::guard('alumni')->login($alumni);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil! Silahkan lengkapi data diri Anda.');
    }
}
