<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JawabanKuesioner;
use App\Models\Kuesioner;
use App\Models\PertanyaanKuesioner;
use Illuminate\Http\Request;

class AdminKuesionerController extends Controller
{
    // ── Kuesioner CRUD ─────────────────────────────────────────────────────────

    public function index()
    {
        $kuesioner = Kuesioner::withCount(['jawaban', 'pertanyaan'])->latest()->get();
        return view('admin.kuesioner.index', compact('kuesioner'));
    }

    public function create()
    {
        return view('admin.kuesioner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => ['required', 'string', 'max:255'],
            'periode_mulai'  => ['required', 'date'],
            'periode_selesai'=> ['required', 'date', 'after_or_equal:periode_mulai'],
            'aktif'          => ['boolean'],
        ]);

        $validated['aktif'] = $request->boolean('aktif');
        $kuesioner = Kuesioner::create($validated);

        return redirect()->route('admin.kuesioner.pertanyaan', $kuesioner)
            ->with('success', 'Kuesioner berhasil dibuat. Sekarang tambahkan pertanyaan.');
    }

    public function edit(Kuesioner $kuesioner)
    {
        return view('admin.kuesioner.edit', compact('kuesioner'));
    }

    public function update(Request $request, Kuesioner $kuesioner)
    {
        $validated = $request->validate([
            'judul'          => ['required', 'string', 'max:255'],
            'periode_mulai'  => ['required', 'date'],
            'periode_selesai'=> ['required', 'date', 'after_or_equal:periode_mulai'],
        ]);

        $validated['aktif'] = $request->boolean('aktif');
        $kuesioner->update($validated);

        return redirect()->route('admin.kuesioner.index')
            ->with('success', 'Kuesioner berhasil diperbarui.');
    }

    public function destroy(Kuesioner $kuesioner)
    {
        $kuesioner->delete();
        return redirect()->route('admin.kuesioner.index')
            ->with('success', 'Kuesioner berhasil dihapus.');
    }

    public function toggleAktif(Kuesioner $kuesioner)
    {
        $kuesioner->update(['aktif' => ! $kuesioner->aktif]);
        $status = $kuesioner->aktif ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Kuesioner berhasil {$status}.");
    }

    // ── Pertanyaan CRUD ────────────────────────────────────────────────────────

    public function pertanyaan(Kuesioner $kuesioner)
    {
        $pertanyaan = $kuesioner->pertanyaan()->get();
        return view('admin.kuesioner.pertanyaan', compact('kuesioner', 'pertanyaan'));
    }

    public function storePertanyaan(Request $request, Kuesioner $kuesioner)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],
            'kelompok'   => ['nullable', 'string', 'max:255'],
            'tipe'       => ['required', 'in:radio,checkbox,text,textarea,select'],
            'opsi'       => ['nullable', 'string'],
            'wajib'      => ['boolean'],
            'urutan'     => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['kuesioner_id'] = $kuesioner->id;
        $validated['wajib']  = $request->boolean('wajib', true);
        $validated['urutan'] = $validated['urutan'] ?? ($kuesioner->pertanyaan()->max('urutan') + 1);

        // Konversi opsi dari textarea (satu per baris) ke array
        if (! empty($validated['opsi'])) {
            $validated['opsi'] = array_values(array_filter(
                array_map('trim', explode("\n", $validated['opsi']))
            ));
        } else {
            $validated['opsi'] = null;
        }

        PertanyaanKuesioner::create($validated);

        return redirect()->route('admin.kuesioner.pertanyaan', $kuesioner)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function updatePertanyaan(Request $request, Kuesioner $kuesioner, PertanyaanKuesioner $pertanyaan)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],
            'kelompok'   => ['nullable', 'string', 'max:255'],
            'tipe'       => ['required', 'in:radio,checkbox,text,textarea,select'],
            'opsi'       => ['nullable', 'string'],
            'wajib'      => ['boolean'],
            'urutan'     => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['wajib']  = $request->boolean('wajib', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if (! empty($validated['opsi'])) {
            $validated['opsi'] = array_values(array_filter(
                array_map('trim', explode("\n", $validated['opsi']))
            ));
        } else {
            $validated['opsi'] = null;
        }

        $pertanyaan->update($validated);

        return redirect()->route('admin.kuesioner.pertanyaan', $kuesioner)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroyPertanyaan(Kuesioner $kuesioner, PertanyaanKuesioner $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->route('admin.kuesioner.pertanyaan', $kuesioner)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }

    // ── Monitoring Pengisian ───────────────────────────────────────────────────

    public function monitoring(Kuesioner $kuesioner)
    {
        $kuesioner->load('pertanyaan');

        $jawaban = JawabanKuesioner::with('alumni')
            ->where('kuesioner_id', $kuesioner->id)
            ->latest('submitted_at')
            ->paginate(20);

        return view('admin.kuesioner.monitoring', compact('kuesioner', 'jawaban'));
    }

    public function detailJawaban(Kuesioner $kuesioner, JawabanKuesioner $jawaban)
    {
        $kuesioner->load('pertanyaan');
        $jawaban->load('alumni');
        return view('admin.kuesioner.detail-jawaban', compact('kuesioner', 'jawaban'));
    }
}
