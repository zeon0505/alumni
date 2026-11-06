@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<h1 class="text-xl font-bold text-gray-800 mb-5">Dashboard</h1>

{{-- Stat cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Alumni</p>
        <p class="text-3xl font-bold text-[#1B5E20] mt-1">{{ $totalAlumni }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide">Sudah Mengisi</p>
        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalIsi }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $kuesionerAktif?->judul ?? 'Tidak ada kuesioner aktif' }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide">Belum Mengisi</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $totalBelumIsi }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide">Kuesioner Aktif</p>
        @if ($kuesionerAktif)
            <p class="text-sm font-semibold text-[#1B5E20] mt-1">{{ $kuesionerAktif->judul }}</p>
            <p class="text-xs text-gray-400">s/d {{ $kuesionerAktif->periode_selesai->format('d M Y') }}</p>
        @else
            <p class="text-sm text-gray-400 mt-1 italic">Tidak ada</p>
        @endif
    </div>
</div>

{{-- Alumni terbaru --}}
<div class="bg-white rounded-lg shadow">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h2 class="font-bold text-gray-800">Alumni Terbaru Mendaftar</h2>
        <a href="{{ route('admin.alumni.index') }}" class="text-sm text-[#1B5E20] hover:underline">Lihat semua →</a>
    </div>
    <div class="divide-y divide-gray-50">
        @forelse ($alumniTerbaru as $a)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $a->name }}</p>
                    <p class="text-xs text-gray-400">{{ $a->nim }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">{{ $a->created_at->locale('id')->diffForHumans() }}</p>
                    <a href="{{ route('admin.alumni.show', $a) }}" class="text-xs text-[#1B5E20] hover:underline">Detail</a>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-400 px-5 py-4 italic">Belum ada alumni terdaftar.</p>
        @endforelse
    </div>
</div>
@endsection
