@extends('layouts.app')
@section('title', 'Profil Alumni')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="space-y-6">

    {{-- ── Hero Profile Card ── --}}
    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">
        {{-- Banner Gradient --}}
        <div class="h-28 sm:h-36 bg-gradient-to-r from-[#1B5E20] via-emerald-800 to-[#2E7D32] relative">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        </div>

        {{-- Profile Info Section --}}
        <div class="px-5 sm:px-8 pb-6 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                <div class="flex flex-col sm:flex-row items-center sm:items-center gap-4 text-center sm:text-left">
                    {{-- Avatar (overlap banner) --}}
                    <div class="relative shrink-0 -mt-12 sm:-mt-16">
                        @if ($alumni->foto)
                            <img src="{{ Storage::url($alumni->foto) }}" alt="Foto {{ $alumni->name }}"
                                 class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover ring-4 ring-white shadow-md bg-white">
                        @else
                            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-emerald-50 text-[#1B5E20] ring-4 ring-white shadow-md flex items-center justify-center text-3xl font-bold">
                                {{ strtoupper(substr($alumni->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Nama & Info (Tepat di area putih, kontras jelas) --}}
                    <div class="pt-2 sm:pt-4 space-y-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">{{ $alumni->name }}</h1>
                        <p class="text-xs sm:text-sm text-slate-500 font-mono">NIM: {{ $alumni->nim }}</p>
                        <p class="text-xs text-slate-600 font-medium">
                            {{ $alumni->dataAkademik?->nama_prodi ?? 'Program Studi Belum Diisi' }}
                            @if ($alumni->dataAkademik?->tahun_angkatan)
                                • Angkatan {{ $alumni->dataAkademik->tahun_angkatan }}
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-2 sm:pt-4 flex items-center justify-center sm:justify-end gap-2.5">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center gap-2 bg-[#1B5E20] hover:bg-[#154a18] text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Data Diri
                    </a>
                </div>
            </div>

            {{-- Quick Badges / Contact Pill --}}
            <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-2 text-xs">
                @if ($alumni->email_pribadi)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-50 text-slate-600 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $alumni->email_pribadi }}
                    </span>
                @endif
                @if ($alumni->telepon)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-50 text-slate-600 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $alumni->telepon }}
                    </span>
                @endif
                @if ($alumni->provinsi || $alumni->kabupaten)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-50 text-slate-600 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $alumni->kabupaten ?? $alumni->provinsi }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- ── 2 Columns Data Details ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Card: Informasi Akademik --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                    </div>
                    <h2 class="font-bold text-slate-800 text-sm sm:text-base">Informasi Akademik</h2>
                </div>
                <a href="{{ route('data-akademik.edit') }}" class="text-xs text-[#1B5E20] font-semibold hover:underline">
                    Edit Data &rarr;
                </a>
            </div>

            @php
                $ak = $alumni->dataAkademik;
                $akademikData = [
                    'NIM'                   => $alumni->nim,
                    'Program Studi'         => $ak?->nama_prodi,
                    'Fakultas'              => $ak?->fakultas,
                    'Jenjang Pendidikan'    => $ak?->tingkat_pendidikan,
                    'Tahun Angkatan'        => $ak?->tahun_angkatan,
                    'Tanggal Masuk'         => $ak?->tanggal_masuk?->format('d/m/Y'),
                    'Tanggal Kelulusan'     => $ak?->tanggal_lulus?->format('d/m/Y'),
                    'Tanggal Wisuda'        => $ak?->tanggal_wisuda?->format('d/m/Y'),
                    'IPK Terakhir'          => $ak?->ipk ? number_format($ak->ipk, 2) : null,
                    'SKS Kumulatif'         => $ak?->sks_kumulatif,
                    'Predikat Kelulusan'    => $ak?->predikat_kelulusan,
                    'Judul Skripsi'         => $ak?->judul_skripsi,
                ];
            @endphp

            <div class="divide-y divide-gray-50 text-xs">
                @foreach ($akademikData as $label => $val)
                    <div class="py-2.5 flex items-start justify-between gap-4">
                        <span class="text-slate-500 font-medium shrink-0 w-36">{{ $label }}</span>
                        <span class="text-slate-800 font-semibold text-right break-words {{ $label === 'IPK Terakhir' && $val ? 'bg-emerald-50 text-emerald-800 px-2 py-0.5 rounded font-mono' : '' }}">
                            {{ $val ?? '-' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Card: Data Pribadi & Kontak --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h2 class="font-bold text-slate-800 text-sm sm:text-base">Data Pribadi & Kontak</h2>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-xs text-[#1B5E20] font-semibold hover:underline">
                    Edit Data &rarr;
                </a>
            </div>

            @php
                $pribadiData = [
                    'Nomor KTP / NIK'       => $alumni->no_ktp,
                    'Tempat Lahir'          => $alumni->tempat_lahir,
                    'Tanggal Lahir'         => $alumni->tanggal_lahir?->format('d/m/Y'),
                    'Jenis Kelamin'         => $alumni->jenis_kelamin,
                    'Status Pernikahan'     => $alumni->status_pernikahan,
                    'Kewarganegaraan'       => $alumni->kewarganegaraan,
                    'Provinsi'              => $alumni->provinsi,
                    'Kabupaten / Kota'      => $alumni->kabupaten,
                    'Alamat Lengkap'        => $alumni->alamat,
                    'Sumber Dana Kuliah'    => $alumni->sumber_dana_kuliah,
                    'Nomor Telepon / WA'    => $alumni->telepon,
                    'Email Pribadi'         => $alumni->email_pribadi,
                    'Email Institusi'       => $alumni->email_institusi,
                    'Sertifikat Kompetensi' => $alumni->sertifikat_kompetensi,
                ];
            @endphp

            <div class="divide-y divide-gray-50 text-xs">
                @foreach ($pribadiData as $label => $val)
                    <div class="py-2.5 flex items-start justify-between gap-4">
                        <span class="text-slate-500 font-medium shrink-0 w-36">{{ $label }}</span>
                        <span class="text-slate-800 font-semibold text-right break-words">
                            @if ($label === 'Sertifikat Kompetensi')
                                <span>{{ $val ?? ($alumni->file_sertifikat ? 'Dokumen Terlampir' : '-') }}</span>
                                @if ($alumni->file_sertifikat)
                                    <a href="{{ Storage::url($alumni->file_sertifikat) }}" target="_blank"
                                       class="inline-flex items-center gap-1 ml-2 text-[11px] font-bold text-[#1B5E20] bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-2 py-0.5 rounded-md transition">
                                        <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        Buka PDF
                                    </a>
                                @endif
                            @else
                                {{ $val ?? '-' }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- Footer Info --}}
    <div class="text-center text-xs text-slate-400 py-2">
        Data terakhir diperbarui pada: {{ $alumni->updated_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB
    </div>

</div>
@endsection
