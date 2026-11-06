@extends('layouts.admin')
@section('title', 'Data Alumni')

@section('content')
<div class="flex items-center justify-between mb-5">
    <h1 class="text-xl font-bold text-gray-800">Data Alumni</h1>
</div>

<div class="bg-white rounded-lg shadow">
    {{-- Search --}}
    <div class="px-5 py-4 border-b border-gray-100">
        <form method="GET" action="{{ route('admin.alumni.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIM atau nama..."
                class="flex-1 bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
            <button type="submit" class="bg-[#1B5E20] text-white px-4 py-2 rounded text-sm hover:bg-[#154a18] transition">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 border rounded text-sm text-gray-600 hover:bg-gray-50">Reset</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">#</th>
                    <th class="px-5 py-3 text-left">NIM</th>
                    <th class="px-5 py-3 text-left">Nama</th>
                    <th class="px-5 py-3 text-left">Program Studi</th>
                    <th class="px-5 py-3 text-left">Terdaftar</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($alumni as $a)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-gray-400">{{ $loop->iteration + ($alumni->currentPage() - 1) * $alumni->perPage() }}</td>
                        <td class="px-5 py-3 font-mono">{{ $a->nim }}</td>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $a->name }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $a->dataAkademik?->nama_prodi ?? '-' }}</td>
                        <td class="px-5 py-3 text-gray-400">{{ $a->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.alumni.show', $a) }}" class="text-xs text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.alumni.edit', $a) }}" class="text-xs text-amber-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.alumni.destroy', $a) }}" onsubmit="return confirm('Hapus alumni {{ $a->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-gray-400 italic">Tidak ada data alumni.</td>
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
@endsection
