<?php

namespace App\Http\Controllers;

use App\Models\JawabanKuesioner;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisionerController extends Controller
{
    public function index()
    {
        $alumni    = Auth::guard('alumni')->user();
        $kuesioner = Kuesioner::where('aktif', true)->latest()->first();
        $jawaban   = null;

        if ($kuesioner) {
            $jawaban = JawabanKuesioner::where('alumni_id', $alumni->id)
                ->where('kuesioner_id', $kuesioner->id)
                ->first();
        }

        return view('kuisioner.index', compact('alumni', 'kuesioner', 'jawaban'));
    }

    public function isi()
    {
        $alumni    = Auth::guard('alumni')->user();
        $kuesioner = Kuesioner::where('aktif', true)
            ->with('pertanyaan')
            ->latest()
            ->first();

        if (! $kuesioner) {
            return redirect()->route('kuisioner')->with('info', 'Tidak ada kuesioner aktif saat ini.');
        }

        if ($kuesioner->pertanyaan->isEmpty()) {
            return redirect()->route('kuisioner')->with('info', 'Kuesioner belum memiliki pertanyaan.');
        }

        $sudahIsi = JawabanKuesioner::where('alumni_id', $alumni->id)
            ->where('kuesioner_id', $kuesioner->id)
            ->exists();

        if ($sudahIsi) {
            return redirect()->route('kuisioner')->with('info', 'Anda sudah mengisi kuesioner ini.');
        }

        return view('kuisioner.isi', compact('alumni', 'kuesioner'));
    }

    public function submit(Request $request)
    {
        $alumni    = Auth::guard('alumni')->user();
        $kuesioner = Kuesioner::where('aktif', true)
            ->with('pertanyaan')
            ->latest()
            ->firstOrFail();

        // Validasi dinamis berdasarkan pertanyaan yang wajib
        $rules = [];
        foreach ($kuesioner->pertanyaan as $p) {
            if ($p->wajib) {
                $rules["jawaban.{$p->id}"] = ['required', 'string'];
            } else {
                $rules["jawaban.{$p->id}"] = ['nullable', 'string'];
            }
        }

        $request->validate($rules, [
            'required' => 'Pertanyaan ini wajib diisi.',
        ]);

        // Cegah double submit
        $existing = JawabanKuesioner::where('alumni_id', $alumni->id)
            ->where('kuesioner_id', $kuesioner->id)
            ->first();

        if ($existing) {
            return redirect()->route('kuisioner')
                ->with('info', 'Anda sudah mengisi kuesioner ini sebelumnya.');
        }

        JawabanKuesioner::create([
            'alumni_id'    => $alumni->id,
            'kuesioner_id' => $kuesioner->id,
            'jawaban'      => $request->input('jawaban', []),
            'submitted_at' => now(),
        ]);

        return redirect()->route('kuisioner')
            ->with('success', 'Terima kasih! Kuesioner berhasil disubmit.');
    }
}
