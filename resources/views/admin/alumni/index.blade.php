@extends('layouts.admin')
@section('title', 'Data Alumni')

@section('content')
<div class="space-y-5">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Database Alumni</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola informasi alumni dan status kuesioner tracer study</p>
        </div>
        <div class="text-xs text-slate-500 bg-white border border-slate-200 px-3.5 py-2 rounded-xl font-medium self-start sm:self-auto shadow-xs">
            Total Alumni: <strong class="text-[#1B5E20] font-bold">{{ $alumni->total() }}</strong> orang
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">

        {{-- Search & Filter Bar --}}
        <div class="p-4 sm:p-5 border-b border-gray-100 bg-slate-50/50">
            <form method="GET" action="{{ route('admin.alumni.index') }}" class="flex flex-col sm:flex-row gap-2.5 max-w-xl">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan NIM atau Nama Alumni..."
                        class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2 pl-9 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]/20 focus:border-[#1B5E20] transition">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition shadow-xs flex items-center gap-1.5">
                        <span>Cari</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.alumni.index') }}" class="px-3 py-2 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-600 hover:bg-slate-100 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left">
                <thead class="bg-slate-50/80 text-slate-500 text-[11px] uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-5 py-3.5">#</th>
                        <th class="px-5 py-3.5">Alumni</th>
                        <th class="px-5 py-3.5">NIM</th>
                        <th class="px-5 py-3.5">Program Studi</th>
                        <th class="px-5 py-3.5">Terdaftar</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($alumni as $a)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-5 py-3.5 text-slate-400 text-xs">
                                {{ $loop->iteration + ($alumni->currentPage() - 1) * $alumni->perPage() }}
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-[#1B5E20] flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($a->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $a->name }}</p>
                                        <p class="text-[11px] text-slate-400 sm:hidden font-mono">{{ $a->nim }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 font-mono text-slate-700 text-xs hidden sm:table-cell">
                                {{ $a->nim }}
                            </td>
                            <td class="px-5 py-3.5 text-slate-600">
                                <span class="inline-block bg-slate-100 text-slate-700 text-xs px-2.5 py-0.5 rounded-md font-medium">
                                    {{ $a->dataAkademik?->nama_prodi ?? 'Belum Diisi' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 text-xs">
                                {{ $a->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.alumni.show', $a) }}" class="text-xs bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-[#1B5E20] px-2.5 py-1.5 rounded-lg font-medium transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.alumni.edit', $a) }}" class="text-xs bg-amber-50 hover:bg-amber-100 text-amber-700 px-2.5 py-1.5 rounded-lg font-medium transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.alumni.destroy', $a) }}" onsubmit="return confirm('Hapus alumni {{ $a->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-2.5 py-1.5 rounded-lg font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="text-sm font-medium">Tidak ada data alumni yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($alumni->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $alumni->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
