@extends('layouts.admin')
@section('title', 'Edit Alumni — ' . $alumni->name)

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.alumni.show', $alumni) }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Detail Alumni
        </a>
        <span class="text-slate-300">/</span>
        <span class="text-xs sm:text-sm text-slate-700 font-semibold truncate">Edit {{ $alumni->name }}</span>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-xs sm:text-sm text-red-700">
            <p class="font-bold mb-1">Terdapat kesalahan pengisian:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Data Alumni --}}
    <form method="POST" action="{{ route('admin.alumni.update', $alumni) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ── Card 1: Data Pribadi & Kontak ── --}}
            <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
                <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2.5">
                    Data Pribadi & Kontak
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $alumni->name) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" name="nim" value="{{ old('nim', $alumni->nim) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor KTP / NIK</label>
                        <input type="text" name="no_ktp" value="{{ old('no_ktp', $alumni->no_ktp) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $alumni->tempat_lahir) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status Pernikahan</label>
                        <select name="status_pernikahan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            <option value="">Pilih</option>
                            <option value="Belum Menikah" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $alumni->kewarganegaraan ?? 'Indonesia') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kabupaten / Kota</label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $alumni->kabupaten) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">{{ old('alamat', $alumni->alamat) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">No. Telepon / WA</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $alumni->telepon) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Pribadi</label>
                        <input type="email" name="email_pribadi" value="{{ old('email_pribadi', $alumni->email_pribadi) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Email Institusi</label>
                    <input type="email" name="email_institusi" value="{{ old('email_institusi', $alumni->email_institusi) }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">LinkedIn</label>
                        <input type="text" name="linkedin" value="{{ old('linkedin', $alumni->linkedin) }}" placeholder="https://..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $alumni->instagram) }}" placeholder="@..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $alumni->facebook) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-3 space-y-3">
                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Kompetensi & Sumber Dana</h3>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Sertifikat Kompetensi <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="sertifikat_kompetensi" value="{{ old('sertifikat_kompetensi', $alumni->sertifikat_kompetensi) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Upload Berkas PDF Sertifikat <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="file" name="file_sertifikat" accept=".pdf"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#1B5E20] hover:file:bg-emerald-100 cursor-pointer">
                        @if ($alumni->file_sertifikat)
                            <div class="mt-2 flex items-center justify-between p-2 bg-emerald-50 rounded-xl border border-emerald-200 text-xs text-[#1B5E20]">
                                <span class="font-medium">File tersimpan</span>
                                <a href="{{ Storage::url($alumni->file_sertifikat) }}" target="_blank" class="font-bold underline">Buka PDF &rarr;</a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Sumber Dana Kuliah</label>
                        <input type="text" name="sumber_dana_kuliah" value="{{ old('sumber_dana_kuliah', $alumni->sumber_dana_kuliah) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>
            </div>

            {{-- ── Card 2: Data Akademik ── --}}
            <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 space-y-4">
                <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2.5">
                    Data Akademik
                </h2>
                @php $ak = $alumni->dataAkademik; @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $ak?->nama_prodi) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Fakultas</label>
                        <input type="text" name="fakultas" value="{{ old('fakultas', $ak?->fakultas) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jenjang Pendidikan</label>
                        <select name="tingkat_pendidikan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            <option value="">Pilih</option>
                            @foreach (['D3', 'S1', 'S2', 'S3'] as $lvl)
                                <option value="{{ $lvl }}" {{ old('tingkat_pendidikan', $ak?->tingkat_pendidikan) == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tahun Angkatan</label>
                        <input type="text" name="tahun_angkatan" maxlength="4" value="{{ old('tahun_angkatan', $ak?->tahun_angkatan) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $ak?->tanggal_masuk?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Kelulusan</label>
                        <input type="date" name="tanggal_lulus" value="{{ old('tanggal_lulus', $ak?->tanggal_lulus?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Yudisium</label>
                        <input type="date" name="tanggal_yudisium" value="{{ old('tanggal_yudisium', $ak?->tanggal_yudisium?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Wisuda</label>
                        <input type="date" name="tanggal_wisuda" value="{{ old('tanggal_wisuda', $ak?->tanggal_wisuda?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Terbit Ijazah</label>
                        <input type="date" name="tanggal_terbit_ijazah" value="{{ old('tanggal_terbit_ijazah', $ak?->tanggal_terbit_ijazah?->format('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">IPK Terakhir</label>
                        <input type="number" step="0.01" min="0" max="4" name="ipk" value="{{ old('ipk', $ak?->ipk) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">SKS Kumulatif</label>
                        <input type="number" min="0" name="sks_kumulatif" value="{{ old('sks_kumulatif', $ak?->sks_kumulatif) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Predikat Kelulusan</label>
                    <input type="text" name="predikat_kelulusan" value="{{ old('predikat_kelulusan', $ak?->predikat_kelulusan) }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Skripsi / Tugas Akhir</label>
                    <textarea name="judul_skripsi" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">{{ old('judul_skripsi', $ak?->judul_skripsi) }}</textarea>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-xs flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.alumni.show', $alumni) }}" class="px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-100 transition">
                Batal
            </a>
        </div>
    </form>

    {{-- Form Reset Password Terpisah --}}
    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 max-w-xl">
        <h2 class="text-xs font-bold text-amber-700 uppercase tracking-wider border-b border-gray-100 pb-2.5 mb-4">
            Reset Password Akun Alumni
        </h2>
        <form method="POST" action="{{ route('admin.alumni.reset-password', $alumni) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password Baru</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:bg-white transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi password baru"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:bg-white transition">
            </div>
            <button type="submit" class="text-xs bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2.5 rounded-xl transition shadow-xs" onclick="return confirm('Reset password alumni ini?')">
                Reset Password Akun
            </button>
        </form>
    </div>

</div>
@endsection
