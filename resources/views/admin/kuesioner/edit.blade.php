@extends('layouts.admin')
@section('title', 'Edit Kuesioner')

@section('content')
<div class="flex items-center gap-3 mb-5">
    <a href="{{ route('admin.kuesioner.index') }}" class="text-sm text-gray-500 hover:text-[#1B5E20] inline-flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
    <h1 class="text-xl font-bold text-gray-800">Edit Kuesioner</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.kuesioner.update', $kuesioner) }}" class="space-y-5">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Kuesioner <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $kuesioner->judul) }}" required
                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Periode Mulai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_mulai" value="{{ old('periode_mulai', $kuesioner->periode_mulai?->format('Y-m-d')) }}" required
                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Periode Selesai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_selesai" value="{{ old('periode_selesai', $kuesioner->periode_selesai?->format('Y-m-d')) }}" required
                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition">
            </div>
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $kuesioner->aktif) ? 'checked' : '' }}
                    class="rounded text-[#1B5E20] focus:ring-[#1B5E20] w-4 h-4">
                <span class="text-sm font-medium text-gray-700">Kuesioner Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-[#1B5E20] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#154a18] transition shadow-sm">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.kuesioner.index') }}" class="px-4 py-2.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

