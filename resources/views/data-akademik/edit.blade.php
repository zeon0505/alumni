@extends('layouts.app')

@section('title', 'Perbaharui Data Akademik')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Title --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Profil
        </a>
        <span class="text-slate-300">/</span>
        <span class="text-xs sm:text-sm text-slate-700 font-semibold">Perbaharui Data Akademik</span>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-slate-50/50">
            <h1 class="text-lg sm:text-xl font-bold text-slate-800">Perbaharui Data Akademik</h1>
            <p class="text-xs text-slate-500 mt-0.5">Lengkapi riwayat akademik perkuliahan dan kelulusan Anda di STAIMAS Wonogiri</p>
        </div>

        <form method="POST" action="{{ route('data-akademik.update') }}" class="p-6 sm:p-8 space-y-6">
            @csrf

            {{-- Errors --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-xs sm:text-sm text-red-700">
                    <p class="font-bold mb-1">Terdapat kesalahan pengisian:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Kolom Kiri: Info Prodi & Gelar --}}
                <div class="space-y-4">
                    <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Program Studi & Angkatan</h2>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" value="{{ $alumni->nim }}" disabled
                            class="w-full bg-slate-100 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-slate-500 font-mono cursor-not-allowed">
                        <p class="text-[10px] text-slate-400 mt-1">NIM terdaftar otomatis dan tidak dapat diubah.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Program Studi</label>
                            <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $dataAkademik?->nama_prodi) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Fakultas</label>
                            <input type="text" name="fakultas" value="{{ old('fakultas', $dataAkademik?->fakultas) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenjang Pendidikan</label>
                            <select name="tingkat_pendidikan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                                <option value="">Pilih Jenjang</option>
                                @foreach (['D3', 'S1', 'S2', 'S3'] as $tingkat)
                                    <option value="{{ $tingkat }}" {{ old('tingkat_pendidikan', $dataAkademik?->tingkat_pendidikan) == $tingkat ? 'selected' : '' }}>
                                        {{ $tingkat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Angkatan</label>
                            <input type="text" name="tahun_angkatan" maxlength="4" value="{{ old('tahun_angkatan', $dataAkademik?->tahun_angkatan) }}" placeholder="Contoh: 2020"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">IPK Kelulusan</label>
                            <input type="number" step="0.01" min="0" max="4" name="ipk" value="{{ old('ipk', $dataAkademik?->ipk) }}" placeholder="Contoh: 3.75"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">SKS Kumulatif</label>
                            <input type="number" min="0" name="sks_kumulatif" value="{{ old('sks_kumulatif', $dataAkademik?->sks_kumulatif) }}" placeholder="Contoh: 144"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Predikat Kelulusan</label>
                        <select name="predikat_kelulusan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            <option value="">Pilih Predikat</option>
                            @foreach (['Dengan Pujian (Cumlaude)', 'Sangat Memuaskan', 'Memuaskan', 'Cukup'] as $predikat)
                                <option value="{{ $predikat }}" {{ old('predikat_kelulusan', $dataAkademik?->predikat_kelulusan) == $predikat ? 'selected' : '' }}>
                                    {{ $predikat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Kolom Kanan: Tanggal & Skripsi --}}
                <div class="space-y-4">
                    <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Tanggal Kelulusan & Skripsi</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $dataAkademik?->tanggal_masuk?->format('Y-m-d')) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Lulus</label>
                            <input type="date" name="tanggal_lulus" value="{{ old('tanggal_lulus', $dataAkademik?->tanggal_lulus?->format('Y-m-d')) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Yudisium</label>
                            <input type="date" name="tanggal_yudisium" value="{{ old('tanggal_yudisium', $dataAkademik?->tanggal_yudisium?->format('Y-m-d')) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Wisuda</label>
                            <input type="date" name="tanggal_wisuda" value="{{ old('tanggal_wisuda', $dataAkademik?->tanggal_wisuda?->format('Y-m-d')) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Terbit Ijazah</label>
                        <input type="date" name="tanggal_terbit_ijazah" value="{{ old('tanggal_terbit_ijazah', $dataAkademik?->tanggal_terbit_ijazah?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Skripsi / Tugas Akhir</label>
                        <textarea name="judul_skripsi" rows="3" placeholder="Masukkan judul skripsi atau tugas akhir Anda..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">{{ old('judul_skripsi', $dataAkademik?->judul_skripsi) }}</textarea>
                    </div>
                </div>

            </div>

            <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white px-6 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition shadow-xs">
                    Simpan Data Akademik
                </button>
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection

