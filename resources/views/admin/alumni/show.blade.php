@extends('layouts.admin')
@section('title', 'Detail Alumni — ' . $alumni->name)

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Action Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.alumni.index') }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Data Alumni
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-xs sm:text-sm text-slate-700 font-semibold truncate">{{ $alumni->name }}</span>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.alumni.edit', $alumni) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-[#1B5E20] hover:bg-[#154a18] text-white transition shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Data
            </a>
        </div>
    </div>

    {{-- Alumni Summary Header Card --}}
    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-5">
        <div class="flex items-center gap-4 min-w-0">
            @if ($alumni->foto)
                <img src="{{ Storage::url($alumni->foto) }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover ring-2 ring-emerald-100 shadow-xs shrink-0">
            @else
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-emerald-50 text-[#1B5E20] ring-2 ring-emerald-100 flex items-center justify-center font-bold text-2xl shrink-0">
                    {{ strtoupper(substr($alumni->name, 0, 2)) }}
                </div>
            @endif
            <div class="min-w-0">
                <h1 class="text-lg sm:text-xl font-bold text-slate-800 truncate">{{ $alumni->name }}</h1>
                <p class="text-xs font-mono text-slate-500 mt-0.5">NIM: {{ $alumni->nim }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-1.5 text-xs">
                    <span class="text-slate-700 font-medium">
                        {{ $alumni->dataAkademik?->nama_prodi ?? 'Program Studi Belum Diisi' }}
                    </span>
                    @if ($alumni->dataAkademik?->tahun_angkatan)
                        <span class="text-slate-300">•</span>
                        <span class="text-slate-500">Angkatan {{ $alumni->dataAkademik->tahun_angkatan }}</span>
                    @endif
                    @if ($alumni->dataAkademik?->ipk)
                        <span class="text-slate-300">•</span>
                        <span class="bg-emerald-50 text-[#1B5E20] px-2 py-0.5 rounded font-mono font-bold">
                            IPK {{ number_format($alumni->dataAkademik->ipk, 2) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-row md:flex-col items-start md:items-end justify-between md:justify-center border-t md:border-t-0 pt-3 md:pt-0 border-gray-100 gap-1.5 text-xs text-slate-400 shrink-0">
            <span>Terdaftar: <strong class="text-slate-600">{{ $alumni->created_at->format('d M Y') }}</strong></span>
            <span>Update: <strong class="text-slate-600">{{ $alumni->updated_at->format('d M Y, H:i') }}</strong></span>
        </div>
    </div>

    {{-- Main 2 Columns Data: Akademik & Pribadi --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ── Card 1: Data Akademik (100% Lengkap) ── --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
            <div class="flex items-center gap-2.5 border-b border-gray-100 pb-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                </div>
                <h2 class="font-bold text-slate-800 text-sm sm:text-base">Data Akademik</h2>
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
                    'Tanggal Yudisium'      => $ak?->tanggal_yudisium?->format('d/m/Y'),
                    'Tanggal Wisuda'        => $ak?->tanggal_wisuda?->format('d/m/Y'),
                    'Tanggal Terbit Ijazah' => $ak?->tanggal_terbit_ijazah?->format('d/m/Y'),
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

        {{-- ── Card 2: Data Pribadi & Kontak (100% Lengkap) ── --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
            <div class="flex items-center gap-2.5 border-b border-gray-100 pb-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 class="font-bold text-slate-800 text-sm sm:text-base">Data Pribadi & Kontak</h2>
            </div>

            <div class="divide-y divide-gray-50 text-xs">
                {{-- Nomor KTP / NIK --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Nomor KTP / NIK</span>
                    <span class="text-slate-800 font-semibold text-right font-mono">{{ $alumni->no_ktp ?? '-' }}</span>
                </div>

                {{-- Tempat & Tgl Lahir --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Tempat, Tanggal Lahir</span>
                    <span class="text-slate-800 font-semibold text-right">
                        @if ($alumni->tempat_lahir || $alumni->tanggal_lahir)
                            {{ $alumni->tempat_lahir }}{{ $alumni->tempat_lahir && $alumni->tanggal_lahir ? ', ' : '' }}{{ $alumni->tanggal_lahir?->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Jenis Kelamin</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->jenis_kelamin ?? '-' }}</span>
                </div>

                {{-- Status Pernikahan --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Status Pernikahan</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->status_pernikahan ?? '-' }}</span>
                </div>

                {{-- Kewarganegaraan --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Kewarganegaraan</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->kewarganegaraan ?? 'Indonesia' }}</span>
                </div>

                {{-- Provinsi --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Provinsi</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->provinsi ?? '-' }}</span>
                </div>

                {{-- Kabupaten / Kota --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Kabupaten / Kota</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->kabupaten ?? '-' }}</span>
                </div>

                {{-- Alamat Lengkap --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Alamat Lengkap</span>
                    <span class="text-slate-800 font-semibold text-right break-words">{{ $alumni->alamat ?? '-' }}</span>
                </div>

                {{-- Sumber Dana Kuliah --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Sumber Dana Kuliah</span>
                    <span class="text-slate-800 font-semibold text-right">{{ $alumni->sumber_dana_kuliah ?? '-' }}</span>
                </div>

                {{-- Nomor Telepon / WA --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Nomor Telepon / WA</span>
                    <div class="text-right">
                        @if ($alumni->telepon)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $alumni->telepon)) }}" target="_blank"
                               class="text-[#1B5E20] hover:underline font-semibold inline-flex items-center gap-1 font-mono">
                                {{ $alumni->telepon }}
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @else
                            <span class="text-slate-800 font-semibold">-</span>
                        @endif
                    </div>
                </div>

                {{-- Email Pribadi --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Email Pribadi</span>
                    <div class="text-right">
                        @if ($alumni->email_pribadi)
                            <a href="mailto:{{ $alumni->email_pribadi }}" class="text-[#1B5E20] hover:underline font-semibold">
                                {{ $alumni->email_pribadi }}
                            </a>
                        @else
                            <span class="text-slate-800 font-semibold">-</span>
                        @endif
                    </div>
                </div>

                {{-- Email Institusi --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Email Institusi</span>
                    <div class="text-right">
                        @if ($alumni->email_institusi)
                            <a href="mailto:{{ $alumni->email_institusi }}" class="text-[#1B5E20] hover:underline font-semibold">
                                {{ $alumni->email_institusi }}
                            </a>
                        @else
                            <span class="text-slate-800 font-semibold">-</span>
                        @endif
                    </div>
                </div>

                {{-- LinkedIn --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">LinkedIn</span>
                    <div class="text-right">
                        @if ($alumni->linkedin)
                            <a href="{{ $alumni->linkedin }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">
                                Profil LinkedIn
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @else
                            <span class="text-slate-800 font-semibold">-</span>
                        @endif
                    </div>
                </div>

                {{-- Instagram --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Instagram</span>
                    <span class="text-slate-800 font-semibold text-right">
                        {{ $alumni->instagram ? '@' . ltrim($alumni->instagram, '@') : '-' }}
                    </span>
                </div>

                {{-- Facebook --}}
                <div class="py-2.5 flex items-start justify-between gap-4">
                    <span class="text-slate-500 font-medium shrink-0 w-36">Facebook</span>
                    <div class="text-right">
                        @if ($alumni->facebook)
                            @if (filter_var($alumni->facebook, FILTER_VALIDATE_URL))
                                <a href="{{ $alumni->facebook }}" target="_blank" class="text-[#1B5E20] hover:underline font-semibold inline-flex items-center gap-1">
                                    Profil Facebook
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @else
                                <span class="text-slate-800 font-semibold">{{ $alumni->facebook }}</span>
                            @endif
                        @else
                            <span class="text-slate-800 font-semibold">-</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Riwayat Pekerjaan, Sertifikat Kompetensi & Kuesioner --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Sertifikat Kompetensi --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4 flex flex-col justify-between">
            <div>
                <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2.5 flex items-center justify-between">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#1B5E20]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        Sertifikat Kompetensi
                    </span>
                    @if ($alumni->file_sertifikat)
                        <span class="bg-emerald-50 text-[#1B5E20] px-2 py-0.5 rounded-full text-[10px] font-bold">PDF Tersedia</span>
                    @endif
                </h2>

                <div class="space-y-3 pt-3 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[11px] mb-0.5 font-medium">Nama / Keterangan Sertifikasi</span>
                        <p class="font-semibold text-slate-800 text-sm">
                            {{ $alumni->sertifikat_kompetensi ?: 'Belum diisi oleh alumni' }}
                        </p>
                    </div>

                    <div class="pt-2">
                        <span class="text-slate-400 block text-[11px] mb-1.5 font-medium">Berkas Dokumen Pendukung</span>
                        @if ($alumni->file_sertifikat)
                            <a href="{{ Storage::url($alumni->file_sertifikat) }}" target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-[#1B5E20] border border-emerald-200 text-xs font-bold transition shadow-xs group">
                                <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <span>Buka Berkas PDF</span>
                                <svg class="w-3.5 h-3.5 text-[#1B5E20] group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @else
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-slate-400 text-xs italic">
                                Belum ada berkas PDF yang diunggah.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Pekerjaan --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-3">
            <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2.5 flex items-center justify-between">
                <span>Riwayat Pekerjaan</span>
                <span class="bg-emerald-50 text-[#1B5E20] px-2 py-0.5 rounded-full text-[11px] font-semibold">{{ $alumni->riwayatPekerjaan->count() }}</span>
            </h2>
            <div class="space-y-2.5">
                @forelse ($alumni->riwayatPekerjaan as $p)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs">
                        <div class="flex items-center justify-between gap-2">
                            <p class="font-bold text-slate-800">{{ $p->jabatan }}</p>
                            @if ($p->masih_bekerja)
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Aktif</span>
                            @endif
                        </div>
                        <p class="text-slate-600 mt-0.5">{{ $p->nama_instansi }}</p>
                        <p class="text-slate-400 text-[11px] mt-1">
                            {{ $p->tanggal_mulai?->format('d M Y') }} — {{ $p->masih_bekerja ? 'Sekarang' : ($p->tanggal_selesai?->format('d M Y') ?? '-') }}
                        </p>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic py-3">Belum ada riwayat pekerjaan terdata.</p>
                @endforelse
            </div>
        </div>

        {{-- Kuesioner Diisi --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-3">
            <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2.5 flex items-center justify-between">
                <span>Kuesioner yang Diisi</span>
                <span class="bg-emerald-50 text-[#1B5E20] px-2 py-0.5 rounded-full text-[11px] font-semibold">{{ $alumni->jawabanKuesioner->count() }}</span>
            </h2>
            <div class="space-y-2.5">
                @forelse ($alumni->jawabanKuesioner as $j)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs flex items-center justify-between gap-3">
                        <div>
                            <p class="font-bold text-slate-800">{{ $j->kuesioner?->judul ?? 'Kuesioner Tracer Study' }}</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                Diisi: {{ $j->submitted_at?->format('d M Y, H:i') ?? $j->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        @if ($j->kuesioner)
                            <a href="{{ route('admin.kuesioner.detail-jawaban', [$j->kuesioner, $j]) }}" class="text-xs text-[#1B5E20] hover:underline font-semibold shrink-0">
                                Lihat Jawaban &rarr;
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic py-3">Alumni ini belum pernah mengisi kuesioner tracer study.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
