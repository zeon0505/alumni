<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\DataAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'name'                 => ['required', 'string', 'max:255'],
            'nim'                  => ['required', 'string', 'unique:alumni,nim,' . $alumni->id],
            'tanggal_lahir'        => ['nullable', 'date'],
            // Data akademik
            'nama_prodi'           => ['nullable', 'string', 'max:255'],
            'fakultas'             => ['nullable', 'string', 'max:255'],
            'tingkat_pendidikan'   => ['nullable', 'string', 'max:50'],
            'tahun_angkatan'       => ['nullable', 'string', 'max:4'],
            'tanggal_masuk'        => ['nullable', 'date'],
            'tanggal_lulus'        => ['nullable', 'date'],
            'tanggal_yudisium'     => ['nullable', 'date'],
            'tanggal_wisuda'       => ['nullable', 'date'],
            'tanggal_terbit_ijazah'=> ['nullable', 'date'],
            'ipk'                  => ['nullable', 'numeric', 'min:0', 'max:4'],
            'sks_kumulatif'        => ['nullable', 'integer'],
            'predikat_kelulusan'   => ['nullable', 'string', 'max:50'],
            'judul_skripsi'        => ['nullable', 'string'],
        ]);

        $alumni->update([
            'name'          => $validated['name'],
            'nim'           => $validated['nim'],
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
        ]);

        if ($request->filled('nama_prodi')) {
            DataAkademik::updateOrCreate(
                ['alumni_id' => $alumni->id],
                [
                    'nim'                   => $validated['nim'],
                    'nama_prodi'            => $validated['nama_prodi'],
                    'fakultas'              => $validated['fakultas'],
                    'tingkat_pendidikan'    => $validated['tingkat_pendidikan'],
                    'tahun_angkatan'        => $validated['tahun_angkatan'],
                    'tanggal_masuk'         => $validated['tanggal_masuk'],
                    'tanggal_lulus'         => $validated['tanggal_lulus'],
                    'tanggal_yudisium'      => $validated['tanggal_yudisium'],
                    'tanggal_wisuda'        => $validated['tanggal_wisuda'],
                    'tanggal_terbit_ijazah' => $validated['tanggal_terbit_ijazah'],
                    'ipk'                   => $validated['ipk'],
                    'sks_kumulatif'         => $validated['sks_kumulatif'],
                    'predikat_kelulusan'    => $validated['predikat_kelulusan'],
                    'judul_skripsi'         => $validated['judul_skripsi'],
                ]
            );
        }

        return redirect()->route('admin.alumni.index')
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
