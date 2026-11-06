@extends('layouts.app')

@section('title', 'Perbaharui Data Diri')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Title --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Profil
        </a>
        <span class="text-slate-300">/</span>
        <span class="text-xs sm:text-sm text-slate-700 font-semibold">Perbaharui Data Diri</span>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-slate-50/50">
            <h1 class="text-lg sm:text-xl font-bold text-slate-800">Perbaharui Data Diri</h1>
            <p class="text-xs text-slate-500 mt-0.5">Pastikan seluruh informasi identitas, domisili, kontak, dan sertifikasi Anda sesuai dengan profil</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf

            {{-- Errors --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-xs sm:text-sm text-red-700">
                    <p class="font-bold mb-1">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- ── Kolom Kiri: Foto, Identitas & Akademik Tambahan ── --}}
                <div class="space-y-6">

                    {{-- Section: Foto Profil --}}
                    <div>
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2 mb-4">Foto Profil</h2>

                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            {{-- Area Foto Interaktif (Klik langsung membuka galeri) --}}
                            <label for="foto-input" class="relative group cursor-pointer shrink-0" title="Klik foto untuk memilih dari galeri">
                                @if ($alumni->foto)
                                    <img src="{{ Storage::url($alumni->foto) }}" class="w-20 h-20 rounded-2xl object-cover ring-2 ring-emerald-200 group-hover:ring-4 group-hover:ring-[#1B5E20]/40 transition" id="preview">
                                @else
                                    <div class="w-20 h-20 rounded-2xl bg-emerald-100 text-[#1B5E20] ring-2 ring-emerald-200 group-hover:ring-4 group-hover:ring-[#1B5E20]/40 flex items-center justify-center font-bold text-2xl transition" id="preview-placeholder">
                                        {{ strtoupper(substr($alumni->name, 0, 2)) }}
                                    </div>
                                    <img src="" class="w-20 h-20 rounded-2xl object-cover ring-2 ring-emerald-200 hidden" id="preview">
                                @endif

                                {{-- Overlay Hover Kamera --}}
                                <div class="absolute inset-0 bg-black/40 rounded-2xl flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="text-[9px] font-semibold mt-0.5">Ubah</span>
                                </div>
                            </label>

                            <div class="min-w-0 flex-1">
                                <label for="foto-input" class="text-xs font-semibold text-slate-700 block mb-1.5 cursor-pointer hover:text-[#1B5E20] transition">
                                    Ganti Foto Profil
                                </label>
                                <input type="file" id="foto-input" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
                                <label for="foto-input" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-[#1B5E20] border border-emerald-200 text-xs font-semibold cursor-pointer transition shadow-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>Pilih dari Galeri</span>
                                </label>
                                <p class="text-[11px] text-slate-400 mt-1.5" id="file-name-info">Klik foto atau tombol di atas (JPG, PNG maks 2MB)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Identitas Personal --}}
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Identitas Personal</h2>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $alumni->name) }}" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor KTP / NIK</label>
                                <input type="text" name="no_ktp" value="{{ old('no_ktp', $alumni->no_ktp) }}" placeholder="33xxxxxxxxxxxxxx"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $alumni->tempat_lahir) }}" placeholder="Kota / Kabupaten"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir?->format('Y-m-d')) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Pernikahan</label>
                                <select name="status_pernikahan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Menikah" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai" {{ old('status_pernikahan', $alumni->status_pernikahan) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $alumni->kewarganegaraan ?? 'Indonesia') }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                        </div>
                    </div>

                    {{-- Section: Sertifikasi & Pendanaan Kuliah --}}
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Kompetensi & Sumber Dana</h2>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Sertifikat Kompetensi <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <input type="text" name="sertifikat_kompetensi" value="{{ old('sertifikat_kompetensi', $alumni->sertifikat_kompetensi) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Upload Dokumen Sertifikat (PDF) <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <input type="file" name="file_sertifikat" accept=".pdf"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#1B5E20] hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[11px] text-slate-400 mt-1">Format file harus berupa PDF, maksimal 5MB</p>

                            @if ($alumni->file_sertifikat)
                                <div class="mt-2.5 flex items-center justify-between p-2.5 bg-emerald-50 rounded-xl border border-emerald-200 text-xs text-[#1B5E20]">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <svg class="w-4 h-4 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span class="font-medium truncate">File sertifikat tersimpan</span>
                                    </div>
                                    <a href="{{ Storage::url($alumni->file_sertifikat) }}" target="_blank" class="font-bold underline hover:text-emerald-900 inline-flex items-center gap-1 shrink-0">
                                        Lihat PDF
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Sumber Dana Kuliah</label>
                            <input type="text" name="sumber_dana_kuliah" value="{{ old('sumber_dana_kuliah', $alumni->sumber_dana_kuliah) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                </div>

                {{-- ── Kolom Kanan: Domisili, Kontak & Sosial Media ── --}}
                <div class="space-y-6">

                    {{-- Section: Domisili & Alamat --}}
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Domisili & Alamat</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}" placeholder="Contoh: Jawa Tengah"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $alumni->kabupaten) }}" placeholder="Contoh: Wonogiri"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" placeholder="Nama Jalan, RT/RW, Dusun/Kelurahan, Kecamatan"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">{{ old('alamat', $alumni->alamat) }}</textarea>
                        </div>
                    </div>

                    {{-- Section: Informasi Kontak --}}
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Informasi Kontak</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Telepon / WA</label>
                                <input type="text" name="telepon" value="{{ old('telepon', $alumni->telepon) }}" placeholder="08xxxxxxxxxx"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Pribadi</label>
                                <input type="email" name="email_pribadi" value="{{ old('email_pribadi', $alumni->email_pribadi) }}" placeholder="nama@gmail.com"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Institusi / Kampus</label>
                            <input type="email" name="email_institusi" value="{{ old('email_institusi', $alumni->email_institusi) }}" placeholder="nama@staimas.ac.id"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>
                    </div>

                    {{-- Section: Media Sosial --}}
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wider border-b border-gray-100 pb-2">Media Sosial & Jaringan</h2>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">LinkedIn Profile</label>
                            <input type="text" name="linkedin" value="{{ old('linkedin', $alumni->linkedin) }}" placeholder="https://linkedin.com/in/username"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Instagram Handle</label>
                                <input type="text" name="instagram" value="{{ old('instagram', $alumni->instagram) }}" placeholder="@username"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Facebook Profile</label>
                                <input type="text" name="facebook" value="{{ old('facebook', $alumni->facebook) }}" placeholder="https://facebook.com/username atau nama profil"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] focus:bg-white transition">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white px-6 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition shadow-xs flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview');
                const placeholder = document.getElementById('preview-placeholder');
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);

            const info = document.getElementById('file-name-info');
            if (info) {
                info.textContent = 'Foto terpilih: ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
                info.classList.remove('text-slate-400');
                info.classList.add('text-emerald-700', 'font-semibold');
            }
        }
    }
</script>
@endsection
