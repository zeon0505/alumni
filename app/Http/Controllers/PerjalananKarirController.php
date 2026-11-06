<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPekerjaan;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatWirausaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerjalananKarirController extends Controller
{
    public function index()
    {
        $alumni = Auth::guard('alumni')->user()->load([
            'riwayatPekerjaan',
            'riwayatPendidikan',
            'riwayatWirausaha',
        ]);
        return view('karir.index', compact('alumni'));
    }

    // ── Pekerjaan ──────────────────────────────────────────────────────────────

    public function storePekerjaan(Request $request)
    {
        $validated = $request->validate([
            'nama_instansi'   => ['required', 'string', 'max:255'],
            'jabatan'         => ['required', 'string', 'max:255'],
            'jenis_pekerjaan' => ['nullable', 'string', 'max:100'],
            'tanggal_mulai'   => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'masih_bekerja'   => ['boolean'],
        ]);

        $validated['alumni_id']   = Auth::guard('alumni')->id();
        $validated['masih_bekerja'] = $request->boolean('masih_bekerja');

        RiwayatPekerjaan::create($validated);

        return redirect()->route('karir')->with('success', 'Data pekerjaan berhasil ditambahkan.');
    }

    public function updatePekerjaan(Request $request, RiwayatPekerjaan $pekerjaan)
    {
        $this->authorizeAlumni($pekerjaan->alumni_id);

        $validated = $request->validate([
            'nama_instansi'   => ['required', 'string', 'max:255'],
            'jabatan'         => ['required', 'string', 'max:255'],
            'jenis_pekerjaan' => ['nullable', 'string', 'max:100'],
            'tanggal_mulai'   => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'masih_bekerja'   => ['boolean'],
        ]);

        $validated['masih_bekerja'] = $request->boolean('masih_bekerja');
        $pekerjaan->update($validated);

        return redirect()->route('karir')->with('success', 'Data pekerjaan berhasil diperbarui.');
    }

    public function destroyPekerjaan(RiwayatPekerjaan $pekerjaan)
    {
        $this->authorizeAlumni($pekerjaan->alumni_id);
        $pekerjaan->delete();
        return redirect()->route('karir')->with('success', 'Data pekerjaan berhasil dihapus.');
    }

    // ── Pendidikan ─────────────────────────────────────────────────────────────

    public function storePendidikan(Request $request)
    {
        $validated = $request->validate([
            'nama_institusi'    => ['nullable', 'string', 'max:255'],
            'jenjang'           => ['nullable', 'string', 'max:50'],
            'bidang_studi'      => ['nullable', 'string', 'max:255'],
            'tanggal_mulai'     => ['nullable', 'date'],
            'tanggal_selesai'   => ['nullable', 'date'],
            'masih_studi'       => ['boolean'],
            'belum_melanjutkan' => ['boolean'],
        ]);

        $validated['alumni_id']         = Auth::guard('alumni')->id();
        $validated['masih_studi']       = $request->boolean('masih_studi');
        $validated['belum_melanjutkan'] = $request->boolean('belum_melanjutkan');

        RiwayatPendidikan::create($validated);

        return redirect()->route('karir')->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    public function updatePendidikan(Request $request, RiwayatPendidikan $pendidikan)
    {
        $this->authorizeAlumni($pendidikan->alumni_id);

        $validated = $request->validate([
            'nama_institusi'    => ['nullable', 'string', 'max:255'],
            'jenjang'           => ['nullable', 'string', 'max:50'],
            'bidang_studi'      => ['nullable', 'string', 'max:255'],
            'tanggal_mulai'     => ['nullable', 'date'],
            'tanggal_selesai'   => ['nullable', 'date'],
            'masih_studi'       => ['boolean'],
            'belum_melanjutkan' => ['boolean'],
        ]);

        $validated['masih_studi']       = $request->boolean('masih_studi');
        $validated['belum_melanjutkan'] = $request->boolean('belum_melanjutkan');
        $pendidikan->update($validated);

        return redirect()->route('karir')->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    public function destroyPendidikan(RiwayatPendidikan $pendidikan)
    {
        $this->authorizeAlumni($pendidikan->alumni_id);
        $pendidikan->delete();
        return redirect()->route('karir')->with('success', 'Data pendidikan berhasil dihapus.');
    }

    // ── Wirausaha ──────────────────────────────────────────────────────────────

    public function storeWirausaha(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'      => ['required', 'string', 'max:255'],
            'jenis_usaha'     => ['nullable', 'string', 'max:100'],
            'deskripsi'       => ['nullable', 'string'],
            'tanggal_mulai'   => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'masih_berjalan'  => ['boolean'],
        ]);

        $validated['alumni_id']     = Auth::guard('alumni')->id();
        $validated['masih_berjalan'] = $request->boolean('masih_berjalan');

        RiwayatWirausaha::create($validated);

        return redirect()->route('karir')->with('success', 'Data wirausaha berhasil ditambahkan.');
    }

    public function updateWirausaha(Request $request, RiwayatWirausaha $wirausaha)
    {
        $this->authorizeAlumni($wirausaha->alumni_id);

        $validated = $request->validate([
            'nama_usaha'      => ['required', 'string', 'max:255'],
            'jenis_usaha'     => ['nullable', 'string', 'max:100'],
            'deskripsi'       => ['nullable', 'string'],
            'tanggal_mulai'   => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'masih_berjalan'  => ['boolean'],
        ]);

        $validated['masih_berjalan'] = $request->boolean('masih_berjalan');
        $wirausaha->update($validated);

        return redirect()->route('karir')->with('success', 'Data wirausaha berhasil diperbarui.');
    }

    public function destroyWirausaha(RiwayatWirausaha $wirausaha)
    {
        $this->authorizeAlumni($wirausaha->alumni_id);
        $wirausaha->delete();
        return redirect()->route('karir')->with('success', 'Data wirausaha berhasil dihapus.');
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    private function authorizeAlumni(int $ownerId): void
    {
        if ($ownerId !== Auth::guard('alumni')->id()) {
            abort(403);
        }
    }
}
