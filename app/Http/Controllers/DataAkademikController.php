<?php

namespace App\Http\Controllers;

use App\Models\DataAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAkademikController extends Controller
{
    public function edit()
    {
        $alumni      = Auth::guard('alumni')->user();
        $dataAkademik = $alumni->dataAkademik;
        return view('data-akademik.edit', compact('alumni', 'dataAkademik'));
    }

    public function update(Request $request)
    {
        $alumni = Auth::guard('alumni')->user();

        $validated = $request->validate([
            'nama_prodi'            => ['nullable', 'string', 'max:255'],
            'fakultas'              => ['nullable', 'string', 'max:255'],
            'tingkat_pendidikan'    => ['nullable', 'string', 'max:50'],
            'tahun_angkatan'        => ['nullable', 'string', 'max:4'],
            'tanggal_masuk'         => ['nullable', 'date'],
            'tanggal_lulus'         => ['nullable', 'date'],
            'tanggal_yudisium'      => ['nullable', 'date'],
            'tanggal_wisuda'        => ['nullable', 'date'],
            'tanggal_terbit_ijazah' => ['nullable', 'date'],
            'ipk'                   => ['nullable', 'numeric', 'min:0', 'max:4'],
            'sks_kumulatif'         => ['nullable', 'integer', 'min:0'],
            'predikat_kelulusan'    => ['nullable', 'string', 'max:50'],
            'judul_skripsi'         => ['nullable', 'string'],
        ]);

        $validated['nim'] = $alumni->nim;

        DataAkademik::updateOrCreate(
            ['alumni_id' => $alumni->id],
            $validated
        );

        return redirect()->route('dashboard')
            ->with('success', 'Data akademik berhasil diperbarui.');
    }
}
