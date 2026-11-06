@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome banner --}}
    <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Selamat Datang, {{ Auth::guard('admin')->user()->name }}!</h1>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Online
                </span>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Berikut ringkasan statistik dan aktivitas sistem informasi alumni STAIMAS Wonogiri.
            </p>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-auto">
            <span class="text-xs text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg flex items-center gap-1.5 font-medium">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Card 1: Total Alumni --}}
        <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Alumni</p>
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalAlumni) }}</p>
                <span class="text-xs text-slate-400 font-medium">terdaftar</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50 flex items-center justify-between text-xs">
                <a href="{{ route('admin.alumni.index') }}" class="text-[#1B5E20] hover:text-green-800 font-semibold inline-flex items-center gap-1">
                    Lihat data <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- Card 2: Sudah Mengisi Kuesioner --}}
        @php
            $persenIsi = $totalAlumni > 0 ? round(($totalIsi / $totalAlumni) * 100) : 0;
        @endphp
        <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sudah Mengisi</p>
                <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <p class="text-3xl font-extrabold text-blue-700 tracking-tight">{{ number_format($totalIsi) }}</p>
                <span class="text-xs text-emerald-600 font-semibold bg-emerald-50 px-1.5 py-0.5 rounded">
                    {{ $persenIsi }}%
                </span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50 text-xs text-slate-400 truncate">
                {{ $kuesionerAktif?->judul ?? 'Tidak ada kuesioner aktif' }}
            </div>
        </div>

        {{-- Card 3: Belum Mengisi Kuesioner --}}
        <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Mengisi</p>
                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <p class="text-3xl font-extrabold text-amber-600 tracking-tight">{{ number_format($totalBelumIsi) }}</p>
                <span class="text-xs text-slate-400 font-medium">alumni tersisa</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50 text-xs text-slate-400">
                Memerlukan tindak lanjut pengisian
            </div>
        </div>

        {{-- Card 4: Kuesioner Aktif --}}
        <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kuesioner Aktif</p>
                <div class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                @if ($kuesionerAktif)
                    <p class="text-sm font-bold text-slate-800 line-clamp-1">{{ $kuesionerAktif->judul }}</p>
                    <p class="text-xs text-slate-400 mt-1">
                        Sampai {{ $kuesionerAktif->periode_selesai?->format('d M Y') }}
                    </p>
                @else
                    <p class="text-sm text-slate-400 italic">Tidak ada kuesioner aktif</p>
                    <p class="text-xs text-slate-400 mt-1">-</p>
                @endif
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50 flex items-center justify-between text-xs">
                <a href="{{ route('admin.kuesioner.index') }}" class="text-[#1B5E20] hover:text-green-800 font-semibold inline-flex items-center gap-1">
                    Kelola <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>

    </div>

    {{-- ── Main Section: 2 Columns ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Alumni Terbaru Mendaftar (2 cols) --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm sm:text-base font-bold text-slate-800">Alumni Terbaru Mendaftar</h2>
                    <p class="text-xs text-slate-400 mt-0.5">5 pendaftar terakhir di sistem</p>
                </div>
                <a href="{{ route('admin.alumni.index') }}" class="text-xs font-semibold text-[#1B5E20] hover:underline inline-flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($alumniTerbaru as $a)
                    <div class="p-4 hover:bg-slate-50/70 transition flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3 min-w-0">
                            {{-- Avatar Initial --}}
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-[#1B5E20] flex items-center justify-center font-bold text-sm shrink-0">
                                {{ strtoupper(substr($a->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $a->name }}</p>
                                <div class="flex items-center gap-2 text-xs text-slate-400">
                                    <span class="font-mono text-slate-600">{{ $a->nim }}</span>
                                    <span>•</span>
                                    <span class="truncate">{{ $a->dataAkademik?->nama_prodi ?? 'Prodi belum diisi' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-xs text-slate-400 hidden sm:inline">
                                {{ $a->created_at->locale('id')->diffForHumans() }}
                            </span>
                            <a href="{{ route('admin.alumni.show', $a) }}" class="text-xs bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-[#1B5E20] border border-slate-200 hover:border-emerald-200 px-3 py-1.5 rounded-lg font-medium transition">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400">
                        <svg class="w-10 h-10 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-sm font-medium">Belum ada alumni yang terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Right: Quick Actions & Status (1 col) --}}
        <div class="space-y-6">

            {{-- Progress Pengisian Kuesioner --}}
            <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5">
                <h3 class="text-sm font-bold text-slate-800 mb-3">Progress Tracer Study</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Tingkat Pengisian</span>
                        <span class="font-bold text-[#1B5E20]">{{ $persenIsi }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div id="progress-bar-tracer" class="bg-[#1B5E20] h-2.5 rounded-full transition-all duration-500"></div>
                    </div>
                    <script>
                        document.getElementById('progress-bar-tracer').style.width = '{{ (int)$persenIsi }}%';
                    </script>
                    <div class="flex items-center justify-between text-[11px] text-slate-400 pt-1">
                        <span>{{ $totalIsi }} Responden</span>
                        <span>Target: {{ $totalAlumni }} Alumni</span>
                    </div>
                </div>
            </div>

            {{-- Akses Cepat / Shortcut --}}
            <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-5">
                <h3 class="text-sm font-bold text-slate-800 mb-3">Akses Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.kuesioner.create') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/50 transition text-xs font-semibold text-slate-700 hover:text-[#1B5E20]">
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 text-[#1B5E20] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </span>
                        <span>Buat Kuesioner Baru</span>
                    </a>

                    <a href="{{ route('admin.alumni.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/50 transition text-xs font-semibold text-slate-700 hover:text-[#1B5E20]">
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 text-[#1B5E20] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                        <span>Kelola Database Alumni</span>
                    </a>

                    @if ($kuesionerAktif)
                        <a href="{{ route('admin.kuesioner.monitoring', $kuesionerAktif) }}" class="flex items-center gap-3 p-2.5 rounded-lg border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/50 transition text-xs font-semibold text-slate-700 hover:text-[#1B5E20]">
                            <span class="w-7 h-7 rounded-lg bg-emerald-100 text-[#1B5E20] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </span>
                            <span>Monitoring Responden Aktif</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
