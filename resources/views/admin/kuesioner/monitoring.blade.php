@extends('layouts.admin')
@section('title', 'Monitoring Responden Kuesioner')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.kuesioner.index') }}" class="text-sm text-gray-500 hover:text-[#1B5E20] inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-800">Monitoring Responden</h1>
            <p class="text-xs text-gray-500">{{ $kuesioner->judul }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">#</th>
                    <th class="px-5 py-3 text-left">NIM</th>
                    <th class="px-5 py-3 text-left">Nama Alumni</th>
                    <th class="px-5 py-3 text-left">Waktu Pengisian</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($jawaban as $j)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-gray-400">{{ $loop->iteration + ($jawaban->currentPage() - 1) * $jawaban->perPage() }}</td>
                        <td class="px-5 py-3 font-mono text-gray-700">{{ $j->alumni?->nim ?? '-' }}</td>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $j->alumni?->name ?? 'Alumni Dihapus' }}</td>
                        <td class="px-5 py-3 text-xs text-gray-500">
                            {{ $j->submitted_at?->format('d/m/Y H:i') ?? $j->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.kuesioner.detail-jawaban', [$kuesioner, $j]) }}" class="text-xs bg-green-50 text-[#1B5E20] font-semibold px-3 py-1.5 rounded hover:bg-green-100 transition inline-flex items-center gap-1">
                                Lihat Jawaban →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-gray-400 italic">
                            Belum ada alumni yang mengisi kuesioner ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($jawaban->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $jawaban->links() }}
        </div>
    @endif
</div>
@endsection

