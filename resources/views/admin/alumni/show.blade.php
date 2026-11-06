@extends('layouts.admin')
@section('title', 'Detail Alumni')

@section('content')
<div class="flex items-center gap-3 mb-5">
    <a href="{{ route('admin.alumni.index') }}" class="text-sm text-gray-500 hover:text-[#1B5E20]">← Kembali</a>
    <h1 class="text-xl font-bold text-gray-800">Detail Alumni</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

    {{-- Identitas --}}
    <div class="bg-white rounded-lg shadow p-5">
        <div class="flex items-center gap-4 mb-4 pb-4 border-b">
            @if ($alumni->foto)
                <img src="{{ Storage::url($alumni->foto) }}" class="w-16 h-16 rounded-full object-cover border-4 border-[#1B5E20]">
            @else
                <div class="w-16 h-16 rounded-full bg-green-100 border-4 border-[#1B5E20] flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#1B5E20]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
            @endif
            <div>
                <p class="font-bold text-gray-800">{{ $alumni->name }}</p>
                <p class="text-sm text-gray-500">{{ $alumni->nim }}</p>
            </div>
        </div>
        <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mb-2">Data Akademik</h3>
        @php $ak = $alumni->dataAkademik; @endphp
        @foreach (['Program Studi' => $ak?->nama_prodi, 'Fakultas' => $ak?->fakultas, 'Angkatan' => $ak?->tahun_angkatan, 'IPK' => $ak?->ipk, 'Predikat' => $ak?->predikat_kelulusan, 'Tanggal Lulus' => $ak?->tanggal_lulus?->format('d/m/Y')] as $lbl => $val)
            <div class="flex gap-2 text-sm py-1 border-b border-gray-50">
                <span class="w-32 text-gray-500 shrink-0">{{ $lbl }}</span>
                <span class="text-gray-800 font-medium">{{ $val ?? '-' }}</span>
            </div>
        @endforeach

        <div class="mt-4 flex gap-2">
            <a href="{{ route('admin.alumni.edit', $alumni) }}" class="bg-[#1B5E20] text-white text-xs px-4 py-2 rounded hover:bg-[#154a18]">Edit Data</a>
        </div>
    </div>

    {{-- Riwayat & Kuisioner --}}
    <div class="space-y-4">
        <div class="bg-white rounded-lg shadow p-5">
            <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mb-3">Riwayat Pekerjaan ({{ $alumni->riwayatPekerjaan->count() }})</h3>
            @forelse ($alumni->riwayatPekerjaan as $p)
                <div class="text-sm py-1 border-b border-gray-50">
                    <span class="font-medium">{{ $p->jabatan }}</span> — {{ $p->nama_instansi }}
                    <span class="text-xs text-gray-400 ml-1">{{ $p->tanggal_mulai->format('Y') }} {{ $p->masih_bekerja ? '– Sekarang' : '' }}</span>
                </div>
            @empty
                <p class="text-xs text-gray-400 italic">Belum ada data.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <h3 class="text-xs font-bold text-[#1B5E20] uppercase tracking-wide mb-3">Status Kuesioner ({{ $alumni->jawabanKuesioner->count() }} diisi)</h3>
            @forelse ($alumni->jawabanKuesioner as $j)
                <div class="text-sm py-1 border-b border-gray-50 flex justify-between">
                    <span>{{ $j->kuesioner->judul }}</span>
                    <span class="text-xs text-green-600 font-semibold">{{ $j->submitted_at?->format('d/m/Y H:i') }}</span>
                </div>
            @empty
                <p class="text-xs text-gray-400 italic">Belum mengisi kuesioner.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
