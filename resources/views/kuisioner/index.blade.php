@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Title --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Profil
        </a>
        <span class="text-slate-300">/</span>
        <span class="text-xs sm:text-sm text-slate-700 font-semibold">Tracer Study</span>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-slate-50/50">
            <h1 class="text-lg sm:text-xl font-bold text-slate-800">Kuisioner Tracer Study</h1>
            <p class="text-xs text-slate-500 mt-0.5">Survei penelusuran lulusan STAIMAS Wonogiri untuk evaluasi dan pengembangan mutu akademik</p>
        </div>

        <div class="p-6 sm:p-8 max-w-3xl space-y-6">
            @if (! $kuesioner)
                <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl p-6 text-center space-y-2">
                    <svg class="w-10 h-10 mx-auto text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <p class="text-sm font-bold">Saat ini belum ada kuesioner tracer study yang sedang aktif.</p>
                    <p class="text-xs text-amber-600">Silakan cek kembali secara berkala.</p>
                </div>
            @else
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h2 class="text-lg font-bold text-slate-800">{{ $kuesioner->judul }}</h2>
                        <div>
                            @if ($jawaban)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Sudah Mengisi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Belum Mengisi
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Periode Pengisian: <strong>{{ $kuesioner->periode_mulai->format('d F Y') }}</strong> s/d <strong>{{ $kuesioner->periode_selesai->format('d F Y') }}</strong></span>
                    </div>
                </div>

                {{-- Petunjuk --}}
                <div class="p-5 bg-emerald-50/50 rounded-2xl border border-emerald-100 text-xs text-slate-600 space-y-2">
                    <p class="font-bold text-[#1B5E20]">Sebelum mengisi kuesioner, diharapkan alumni memastikan:</p>
                    <ol class="list-decimal list-inside space-y-1 pl-1">
                        <li>Data diri dan kontak telah diperbarui di menu <strong>Profil Saya</strong>.</li>
                        <li>Riwayat pekerjaan telah diisi di menu <strong>Perjalanan Karir</strong>.</li>
                        <li>Riwayat studi lanjut atau wirausaha (jika ada) telah ditambahkan.</li>
                    </ol>
                </div>

                <div class="pt-2">
                    @if ($jawaban)
                        <a href="{{ route('kuisioner.isi') }}"
                           class="inline-flex items-center gap-2 bg-[#1B5E20] hover:bg-[#154a18] text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Tinjau Jawaban Anda
                        </a>
                    @else
                        @if (now()->between($kuesioner->periode_mulai, $kuesioner->periode_selesai))
                            <a href="{{ route('kuisioner.isi') }}"
                               class="inline-flex items-center gap-2 bg-[#1B5E20] hover:bg-[#154a18] text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Isi Kuesioner Sekarang
                            </a>
                        @else
                            <p class="text-xs text-slate-400 italic">Periode pengisian kuesioner ini belum dimulai atau sudah berakhir.</p>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
