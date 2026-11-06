<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        /** @var Alumni $alumni */
        $alumni = Auth::guard('alumni')->user();

        return view('profile.edit', compact('alumni'));
    }

    public function update(Request $request)
    {
        /** @var Alumni $alumni */
        $alumni = Auth::guard('alumni')->user();

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'no_ktp' => ['nullable', 'string', 'max:20'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:Laki-laki,Perempuan'],
            'status_pernikahan' => ['nullable', 'in:Belum Menikah,Menikah,Cerai'],
            'kewarganegaraan' => ['nullable', 'string', 'max:50'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'sertifikat_kompetensi' => ['nullable', 'string', 'max:255'],
            'file_sertifikat' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'sumber_dana_kuliah' => ['nullable', 'string', 'max:100'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'email_pribadi' => ['nullable', 'email', 'max:100'],
            'email_institusi' => ['nullable', 'email', 'max:100'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:100'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto-alumni', 'public');
        }

        if ($request->hasFile('file_sertifikat')) {
            // Hapus file sertifikat lama jika ada
            if ($alumni->file_sertifikat) {
                Storage::disk('public')->delete($alumni->file_sertifikat);
            }
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('sertifikat-alumni', 'public');
        }

        $alumni->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Data diri berhasil diperbarui.');
    }
}
