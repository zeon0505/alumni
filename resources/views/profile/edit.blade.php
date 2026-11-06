@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="bg-[#1B5E20] text-white px-6 py-4 rounded-t-lg">
        <h1 class="text-lg font-bold">Perbaharui Data Diri</h1>
        <p class="text-xs text-green-200 mt-0.5">Update informasi pribadi dan kontak Anda</p>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6">
        @csrf

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 rounded-lg px-4 py-3">
                <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan:</p>
                <ul class="text-sm text-red-600 list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Kiri --}}
            <div class="space-y-4">
                <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2">Foto Profil</h2>

                {{-- Preview --}}
                <div class="flex items-center gap-4">
                    @if ($alumni->foto)
                        <img src="{{ Storage::url($alumni->foto) }}" class="w-20 h-20 rounded-full object-cover border-4 border-[#1B5E20]" id="preview">
                    @else
                        <div class="w-20 h-20 rounded-full bg-green-50 border-4 border-[#1B5E20] flex items-center justify-center" id="preview-placeholder">
                            <svg class="w-10 h-10 text-green-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </div>
                        <img src="" class="w-20 h-20 rounded-full object-cover border-4 border-[#1B5E20] hidden" id="preview">
                    @endif
                    <div>
                        <label class="text-xs font-medium text-gray-600 block mb-1">Upload Foto</label>
                        <input type="file" name="foto" accept="image/*" class="text-sm text-gray-600"
                               onchange="previewFoto(this)">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG — maks 2MB</p>
                    </div>
                </div>

                <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2 pt-2">Data Pribadi</h2>

                @php
                    $fields = [
                        ['no_ktp', 'Nomor KTP', 'text', ''],
                        ['tempat_lahir', 'Tempat Lahir', 'text', ''],
                        ['tanggal_lahir', 'Tanggal Lahir', 'date', ''],
                    ];
                @endphp
                @foreach ($fields as [$name, $label, $type, $placeholder])
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">{{ $label }}</label>
                        <input type="{{ $type }}" name="{{ $name }}"
                            value="{{ old($name, $alumni->$name instanceof \Carbon\Carbon ? $alumni->$name->format('Y-m-d') : $alumni->$name) }}"
                            placeholder="{{ $placeholder }}"
                            class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                    </div>
                @endforeach

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                        <option value="">-- Pilih --</option>
                        @foreach (['Laki-laki', 'Perempuan'] as $opt)
                            <option value="{{ $opt }}" {{ old('jenis_kelamin', $alumni->jenis_kelamin) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Status Pernikahan</label>
                    <select name="status_pernikahan" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                        <option value="">-- Pilih --</option>
                        @foreach (['Belum Menikah', 'Menikah', 'Cerai'] as $opt)
                            <option value="{{ $opt }}" {{ old('status_pernikahan', $alumni->status_pernikahan) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Kewarganegaraan</label>
                    <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $alumni->kewarganegaraan) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2 pt-2">Tempat Tinggal</h2>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Kabupaten / Kota</label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten', $alumni->kabupaten) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">{{ old('alamat', $alumni->alamat) }}</textarea>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="space-y-4">
                <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2">Informasi Lainnya</h2>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Sertifikat Kompetensi</label>
                    <input type="text" name="sertifikat_kompetensi" value="{{ old('sertifikat_kompetensi', $alumni->sertifikat_kompetensi) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Sumber Dana Kuliah</label>
                    <input type="text" name="sumber_dana_kuliah" value="{{ old('sumber_dana_kuliah', $alumni->sumber_dana_kuliah) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>

                <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2 pt-2">Informasi Kontak</h2>

                @php
                    $kontakFields = [
                        ['telepon', 'Telepon', 'text'],
                        ['email_pribadi', 'Email Pribadi', 'email'],
                        ['email_institusi', 'Email Institusi', 'email'],
                        ['linkedin', 'LinkedIn (URL)', 'url'],
                        ['facebook', 'Facebook', 'text'],
                        ['instagram', 'Instagram (username)', 'text'],
                    ];
                @endphp
                @foreach ($kontakFields as [$name, $label, $type])
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">{{ $label }}</label>
                        <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $alumni->$name) }}"
                            class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
            <a href="{{ route('dashboard') }}" class="px-5 py-2 text-sm text-gray-600 border border-gray-200 rounded hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-6 py-2 rounded transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('preview-placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
