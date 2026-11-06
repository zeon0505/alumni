@extends('layouts.admin')
@section('title', 'Detail Jawaban Kuesioner')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.kuesioner.monitoring', $kuesioner) }}" class="text-sm text-gray-500 hover:text-[#1B5E20] inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <h1 class="text-xl font-bold text-gray-800">Detail Jawaban Responden</h1>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Info Alumni --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-3">
            <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2">Informasi Responden</h2>
            <div>
                <p class="text-xs text-gray-400">Nama Lengkap</p>
                <p class="text-sm font-bold text-gray-800">{{ $jawaban->alumni?->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400">NIM</p>
                <p class="text-sm font-mono text-gray-700">{{ $jawaban->alumni?->nim ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400">Program Studi</p>
                <p class="text-sm text-gray-700">{{ $jawaban->alumni?->dataAkademik?->nama_prodi ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400">Waktu Pengisian</p>
                <p class="text-sm text-gray-700">{{ $jawaban->submitted_at?->format('d F Y, H:i') ?? $jawaban->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Jawaban --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-3 mb-4">Jawaban Kuesioner</h2>

            @php $rawJawaban = $jawaban->jawaban ?? []; @endphp

            @if ($kuesioner->pertanyaan->count() > 0)
                <div class="space-y-4">
                    @foreach ($kuesioner->pertanyaan as $p)
                        @php
                            $ans = $rawJawaban[$p->id] ?? null;
                        @endphp
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-start gap-2 mb-2">
                                <span class="w-5 h-5 rounded-full bg-white text-[#1B5E20] text-xs font-bold flex items-center justify-center shrink-0 border border-green-200">
                                    {{ $loop->iteration }}
                                </span>
                                <h3 class="text-sm font-medium text-gray-800">{{ $p->pertanyaan }}</h3>
                            </div>
                            <div class="pl-7">
                                @if (is_array($ans))
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($ans as $val)
                                            <span class="inline-block bg-white text-[#1B5E20] border border-green-200 text-xs font-medium px-2.5 py-1 rounded">
                                                {{ $val }}
                                            </span>
                                        @endforeach
                                    </div>
                                @elseif (!empty($ans))
                                    <p class="text-sm font-semibold text-gray-800 bg-white border border-gray-200 rounded px-3 py-2">
                                        {{ $ans }}
                                    </p>
                                @else
                                    <p class="text-xs text-gray-400 italic">Tidak dijawab</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Format dinamis / array key-value --}}
                <div class="space-y-3">
                    @forelse ($rawJawaban as $key => $val)
                        <div class="bg-gray-50 rounded-lg p-3.5 border border-gray-100">
                            <p class="text-xs text-gray-500 font-semibold mb-1 uppercase tracking-wide">{{ str_replace('_', ' ', $key) }}</p>
                            @if (is_array($val))
                                <p class="text-sm font-medium text-gray-800">{{ implode(', ', $val) }}</p>
                            @else
                                <p class="text-sm font-medium text-gray-800">{{ $val }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Data jawaban kosong.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

