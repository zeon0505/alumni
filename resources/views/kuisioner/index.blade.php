@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="bg-[#1B5E20] text-white px-6 py-4 rounded-t-lg">
        <h1 class="text-lg font-bold">Kuisioner Tracer Study</h1>
    </div>

    <div class="p-6">
        @if (! $kuesioner)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg px-4 py-3 text-sm">
                Tidak ada kuesioner aktif saat ini.
            </div>
        @else
            <h2 class="text-xl font-bold text-[#1B5E20] mb-1">{{ $kuesioner->judul }}</h2>

            <div class="flex items-center gap-2 mb-3">
                <span class="text-sm text-gray-500">Status Pengisian:</span>
                @if ($jawaban)
                    <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Sudah Mengisi</span>
                @else
                    <span class="bg-amber-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Belum Mengisi</span>
                @endif
            </div>

            <p class="text-sm text-gray-600 mb-4">
                Tanggal Pengisian:
                <span class="font-semibold text-gray-800">
                    {{ $kuesioner->periode_mulai->format('d F Y') }} – {{ $kuesioner->periode_selesai->format('d F Y') }}
                </span>
            </p>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-5">
                <p class="text-sm text-gray-700 mb-2">Sebelum melakukan pengisian kuesioner ini, diharapkan bagi alumni untuk:</p>
                <ol class="list-decimal list-inside space-y-1 text-sm text-gray-700">
                    <li>Melakukan pembaruan data diri pada menu profile</li>
                    <li>Melakukan pembaruan riwayat pekerjaan pada menu perjalanan karir</li>
                    <li>Melakukan pembaruan riwayat pendidikan pada menu perjalanan karir</li>
                </ol>
            </div>

            @if ($jawaban)
                <a href="{{ route('kuisioner.isi') }}"
                   class="inline-flex items-center gap-2 bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-5 py-2.5 rounded transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Tinjau Kuesioner
                </a>
            @else
                @if (now()->between($kuesioner->periode_mulai, $kuesioner->periode_selesai))
                    <a href="{{ route('kuisioner.isi') }}"
                       class="inline-flex items-center gap-2 bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-5 py-2.5 rounded transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Isi Kuesioner
                    </a>
                @else
                    <p class="text-sm text-gray-500 italic">Pengisian di luar periode.</p>
                @endif
            @endif
        @endif
    </div>
</div>
@endsection
