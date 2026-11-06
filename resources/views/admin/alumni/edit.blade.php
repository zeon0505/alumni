@extends('layouts.admin')
@section('title', 'Edit Alumni')

@section('content')
<div class="flex items-center gap-3 mb-5">
    <a href="{{ route('admin.alumni.index') }}" class="text-sm text-gray-500 hover:text-[#1B5E20]">← Kembali</a>
    <h1 class="text-xl font-bold text-gray-800">Edit Alumni: {{ $alumni->name }}</h1>
</div>

<form method="POST" action="{{ route('admin.alumni.update', $alumni) }}" class="space-y-5">
    @csrf @method('PUT')

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        {{-- Identitas --}}
        <div class="bg-white rounded-lg shadow p-5 space-y-4">
            <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2">Identitas Dasar</h2>
            @foreach (['name' => 'Nama Lengkap', 'nim' => 'NIM'] as $field => $label)
                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ $label }}</label>
                    <input type="text" name="{{ $field }}" value="{{ old($field, $alumni->$field) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
            @endforeach
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir?->format('Y-m-d')) }}"
                    class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
            </div>

            <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2 pt-2">Reset Password</h2>
            <form method="POST" action="{{ route('admin.alumni.reset-password', $alumni) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password Baru</label>
                    <input type="password" name="password" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
                <button type="submit" class="text-sm bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded transition" onclick="return confirm('Reset password alumni ini?')">
                    Reset Password
                </button>
            </form>
        </div>

        {{-- Data Akademik --}}
        <div class="bg-white rounded-lg shadow p-5 space-y-3">
            <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2">Data Akademik</h2>
            @php
                $ak = $alumni->dataAkademik;
                $fields = [
                    'nama_prodi' => ['Nama Program Studi', 'text'],
                    'fakultas' => ['Fakultas', 'text'],
                    'tingkat_pendidikan' => ['Tingkat Pendidikan', 'text'],
                    'tahun_angkatan' => ['Tahun Angkatan', 'text'],
                    'tanggal_masuk' => ['Tanggal Masuk', 'date'],
                    'tanggal_lulus' => ['Tanggal Lulus', 'date'],
                    'tanggal_yudisium' => ['Tanggal Yudisium', 'date'],
                    'tanggal_wisuda' => ['Tanggal Wisuda', 'date'],
                    'tanggal_terbit_ijazah' => ['Tanggal Terbit Ijazah', 'date'],
                    'ipk' => ['IPK', 'number'],
                    'sks_kumulatif' => ['SKS Kumulatif', 'number'],
                    'predikat_kelulusan' => ['Predikat Kelulusan', 'text'],
                ];
            @endphp
            @foreach ($fields as $f => [$label, $type])
                <div>
                    <label class="block text-sm text-gray-600 mb-1">{{ $label }}</label>
                    <input type="{{ $type }}" name="{{ $f }}"
                        value="{{ old($f, $ak?->$f instanceof \Carbon\Carbon ? $ak->$f->format('Y-m-d') : $ak?->$f) }}"
                        @if ($type === 'number' && $f === 'ipk') step="0.01" min="0" max="4" @endif
                        class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                </div>
            @endforeach
            <div>
                <label class="block text-sm text-gray-600 mb-1">Judul Skripsi</label>
                <textarea name="judul_skripsi" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">{{ old('judul_skripsi', $ak?->judul_skripsi) }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.alumni.index') }}" class="px-5 py-2 text-sm border rounded text-gray-600 hover:bg-gray-50">Batal</a>
        <button type="submit" class="bg-[#1B5E20] text-white text-sm font-semibold px-6 py-2 rounded hover:bg-[#154a18] transition">Simpan Perubahan</button>
    </div>
</form>
@endsection
