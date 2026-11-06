<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\DataAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminAlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::with('dataAkademik');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $alumni = $query->latest()->paginate(15)->withQueryString();

        return view('admin.alumni.index', compact('alumni'));
    }

    public function show(Alumni $alumni)
    {
        $alumni->load('dataAkademik', 'riwayatPekerjaan', 'riwayatPendidikan', 'riwayatWirausaha', 'jawabanKuesioner.kuesioner');

        return view('admin.alumni.show', compact('alumni'));
    }

    public function edit(Alumni $alumni)
    {
        $alumni->load('dataAkademik');

        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'unique:alumni,nim,'.$alumni->id],
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
            // Data akademik
            'nama_prodi' => ['nullable', 'string', 'max:255'],
            'fakultas' => ['nullable', 'string', 'max:255'],
            'tingkat_pendidikan' => ['nullable', 'string', 'max:50'],
            'tahun_angkatan' => ['nullable', 'string', 'max:4'],
            'tanggal_masuk' => ['nullable', 'date'],
            'tanggal_lulus' => ['nullable', 'date'],
            'tanggal_yudisium' => ['nullable', 'date'],
            'tanggal_wisuda' => ['nullable', 'date'],
            'tanggal_terbit_ijazah' => ['nullable', 'date'],
            'ipk' => ['nullable', 'numeric', 'min:0', 'max:4'],
            'sks_kumulatif' => ['nullable', 'integer'],
            'predikat_kelulusan' => ['nullable', 'string', 'max:50'],
            'judul_skripsi' => ['nullable', 'string'],
        ]);

        $alumniData = [
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'no_ktp' => $validated['no_ktp'] ?? null,
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'status_pernikahan' => $validated['status_pernikahan'] ?? null,
            'kewarganegaraan' => $validated['kewarganegaraan'] ?? 'Indonesia',
            'provinsi' => $validated['provinsi'] ?? null,
            'kabupaten' => $validated['kabupaten'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'sertifikat_kompetensi' => $validated['sertifikat_kompetensi'] ?? null,
            'sumber_dana_kuliah' => $validated['sumber_dana_kuliah'] ?? null,
            'telepon' => $validated['telepon'] ?? null,
            'email_pribadi' => $validated['email_pribadi'] ?? null,
            'email_institusi' => $validated['email_institusi'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
        ];

        if ($request->hasFile('file_sertifikat')) {
            if ($alumni->file_sertifikat) {
                Storage::disk('public')->delete($alumni->file_sertifikat);
            }
            $alumniData['file_sertifikat'] = $request->file('file_sertifikat')->store('sertifikat-alumni', 'public');
        }

        $alumni->update($alumniData);

        if ($request->filled('nama_prodi') || $request->filled('fakultas') || $request->filled('tingkat_pendidikan')) {
            DataAkademik::updateOrCreate(
                ['alumni_id' => $alumni->id],
                [
                    'nim' => $validated['nim'],
                    'nama_prodi' => $validated['nama_prodi'] ?? null,
                    'fakultas' => $validated['fakultas'] ?? null,
                    'tingkat_pendidikan' => $validated['tingkat_pendidikan'] ?? null,
                    'tahun_angkatan' => $validated['tahun_angkatan'] ?? null,
                    'tanggal_masuk' => $validated['tanggal_masuk'] ?? null,
                    'tanggal_lulus' => $validated['tanggal_lulus'] ?? null,
                    'tanggal_yudisium' => $validated['tanggal_yudisium'] ?? null,
                    'tanggal_wisuda' => $validated['tanggal_wisuda'] ?? null,
                    'tanggal_terbit_ijazah' => $validated['tanggal_terbit_ijazah'] ?? null,
                    'ipk' => $validated['ipk'] ?? null,
                    'sks_kumulatif' => $validated['sks_kumulatif'] ?? null,
                    'predikat_kelulusan' => $validated['predikat_kelulusan'] ?? null,
                    'judul_skripsi' => $validated['judul_skripsi'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.alumni.show', $alumni)
            ->with('success', "Data alumni {$alumni->name} berhasil diperbarui.");
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil dihapus.');
    }

    public function resetPassword(Request $request, Alumni $alumni)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $alumni->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password alumni berhasil direset.');
    }
}
