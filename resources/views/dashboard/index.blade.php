@extends('layouts.app')
@section('title', 'Profile')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')

{{-- Content header bar --}}
<div class="bg-white border-b border-gray-200 px-4 py-2.5 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <span class="text-sm font-semibold text-gray-700">Profile</span>
    </div>
    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
</div>

<div class="bg-white shadow-sm">

    {{-- Mobile: stack, Desktop: 3 kolom --}}
    <div class="flex flex-col lg:flex-row lg:divide-x lg:divide-gray-100">

        {{-- Kolom 1: Foto + kontak --}}
        <div class="lg:w-44 lg:shrink-0 p-4 flex flex-row lg:flex-col items-center lg:items-center gap-4 lg:gap-0 border-b lg:border-b-0 border-gray-100">
            {{-- Avatar --}}
            @if ($alumni->foto)
                <img src="{{ Storage::url($alumni->foto) }}" alt="Foto"
                     class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 shrink-0 lg:mb-2">
            @else
                <div class="w-20 h-20 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center shrink-0 lg:mb-2">
                    <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            @endif

            <div class="flex-1 lg:flex-none lg:w-full lg:text-center">
                <p class="text-sm font-bold text-gray-800 lg:text-center">{{ $alumni->name }}</p>
                <p class="text-xs text-gray-400 lg:text-center mb-2">{{ $alumni->nim }}</p>

                {{-- Kontak sosial --}}
                <div class="space-y-1.5 text-xs">
                    @if ($alumni->telepon)
                        <div class="flex items-center gap-1.5">
                            <div class="w-5 h-5 rounded bg-[#1B5E20] flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="text-gray-600 truncate">{{ $alumni->telepon }}</span>
                        </div>
                    @endif
                    @if ($alumni->email_pribadi)
                        <div class="flex items-center gap-1.5">
                            <div class="w-5 h-5 rounded bg-[#1B5E20] flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-[#1B5E20] truncate">{{ $alumni->email_pribadi }}</span>
                        </div>
                    @endif
                    @if ($alumni->linkedin)
                        <div class="flex items-center gap-1.5">
                            <div class="w-5 h-5 rounded bg-[#1B5E20] flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </div>
                            <span class="text-[#1B5E20] truncate">LinkedIn</span>
                        </div>
                    @endif
                    @if ($alumni->facebook)
                        <div class="flex items-center gap-1.5">
                            <div class="w-5 h-5 rounded bg-[#1B5E20] flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <span class="text-[#1B5E20] truncate">{{ $alumni->facebook }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom 2 + 3: Di mobile grid 2 kolom, di desktop tetap 2 kolom terpisah --}}
        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:divide-x lg:divide-gray-100 border-b lg:border-b-0 border-gray-100">

            {{-- Informasi Akademik --}}
            <div class="p-4 border-b sm:border-b-0 sm:border-r border-gray-100 lg:border-0">
                <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mb-2">Informasi Akademik</h3>
                @php
                    $ak = $alumni->dataAkademik;
                    $akademikRows = [
                        'NIM'                   => $alumni->nim,
                        'Nama Program Studi'    => $ak?->nama_prodi,
                        'Fakultas'              => $ak?->fakultas,
                        'Tingkat Pendidikan'    => $ak?->tingkat_pendidikan,
                        'Tahun Angkatan'        => $ak?->tahun_angkatan,
                        'Tanggal Masuk'         => $ak?->tanggal_masuk?->format('d-m-Y'),
                        'Tanggal Lulus'         => $ak?->tanggal_lulus?->format('d-m-Y'),
                        'Tanggal Yudisium'      => $ak?->tanggal_yudisium?->format('d-m-Y'),
                        'Tanggal Wisuda'        => $ak?->tanggal_wisuda?->format('d-m-Y'),
                        'Tanggal Terbit Ijazah' => $ak?->tanggal_terbit_ijazah?->format('d-m-Y'),
                        'IPK'                   => $ak?->ipk ? number_format($ak->ipk, 2) : null,
                        'SKS Kumulatif'         => $ak?->sks_kumulatif,
                        'Predikat Kelulusan'    => $ak?->predikat_kelulusan,
                        'Judul Skripsi'         => $ak?->judul_skripsi,
                    ];
                @endphp
                <table class="w-full text-xs">
                    <tbody>
                        @foreach ($akademikRows as $label => $value)
                            <tr>
                                <td class="py-[3px] align-top whitespace-nowrap pr-1 w-32
                                           {{ $value ? 'text-[#1B5E20]' : 'text-gray-400' }}">{{ $label }}</td>
                                <td class="py-[3px] text-gray-300 px-1 align-top">:</td>
                                <td class="py-[3px] text-gray-700 align-top break-words">{{ $value ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Informasi Pribadi + Kontak --}}
            <div class="p-4">
                <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mb-2">Informasi Pribadi</h3>
                @php
                    $pribadiRows = [
                        'Nomor KTP'             => $alumni->no_ktp,
                        'Tempat Lahir'          => $alumni->tempat_lahir,
                        'Tanggal Lahir'         => $alumni->tanggal_lahir?->format('d-m-Y'),
                        'Jenis Kelamin'         => $alumni->jenis_kelamin,
                        'Status Pernikahan'     => $alumni->status_pernikahan,
                        'Kewarganegaraan'       => $alumni->kewarganegaraan,
                        'Provinsi'              => $alumni->provinsi,
                        'Kabupaten'             => $alumni->kabupaten,
                        'Alamat'                => $alumni->alamat,
                        'Sertifikat Kompetensi' => $alumni->sertifikat_kompetensi,
                        'Sumber Dana Kuliah'    => $alumni->sumber_dana_kuliah,
                    ];
                @endphp
                <table class="w-full text-xs">
                    <tbody>
                        @foreach ($pribadiRows as $label => $value)
                            <tr>
                                <td class="py-[3px] align-top whitespace-nowrap pr-1 w-32
                                           {{ $value ? 'text-[#1B5E20]' : 'text-gray-400' }}">{{ $label }}</td>
                                <td class="py-[3px] text-gray-300 px-1 align-top">:</td>
                                <td class="py-[3px] text-gray-700 align-top break-words">{{ $value ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mt-3 mb-2">Informasi Kontak</h3>
                @php
                    $kontakRows = [
                        'Telepon'        => $alumni->telepon,
                        'Email Pribadi'  => $alumni->email_pribadi,
                        'Email Institusi'=> $alumni->email_institusi,
                        'Instagram'      => $alumni->instagram,
                    ];
                @endphp
                <table class="w-full text-xs">
                    <tbody>
                        @foreach ($kontakRows as $label => $value)
                            <tr>
                                <td class="py-[3px] align-top whitespace-nowrap pr-1 w-32
                                           {{ $value ? 'text-[#1B5E20]' : 'text-gray-400' }}">{{ $label }}</td>
                                <td class="py-[3px] text-gray-300 px-1 align-top">:</td>
                                <td class="py-[3px] text-gray-700 align-top break-words">{{ $value ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer: timestamp + tombol --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 px-4 py-3 bg-white border-t border-gray-100">
        <p class="text-[10px] text-gray-400">
            Pembaruan: {{ $alumni->updated_at->format('d-m-Y H:i:s') }}
        </p>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-1.5 bg-[#1B5E20] hover:bg-[#154a18] text-white text-xs font-semibold px-4 py-2 rounded transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Perbaharui Data Diri
        </a>
    </div>
</div>

@endsection
