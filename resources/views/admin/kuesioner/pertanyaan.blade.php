@extends('layouts.admin')
@section('title', 'Kelola Pertanyaan Kuesioner')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.kuesioner.index') }}" class="text-sm text-gray-500 hover:text-[#1B5E20] inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <h1 class="text-xl font-bold text-gray-800">Pertanyaan: {{ $kuesioner->judul }}</h1>
    </div>
    <a href="{{ route('admin.kuesioner.monitoring', $kuesioner) }}" class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1.5 rounded-lg hover:bg-blue-100 font-semibold transition">
        Lihat Responden ({{ $kuesioner->jawaban()->count() }})
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Form Tambah Pertanyaan --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sticky top-20">
            <h2 class="text-sm font-bold text-[#1B5E20] uppercase tracking-wide border-b pb-2 mb-4">Tambah Pertanyaan</h2>
            <form method="POST" action="{{ route('admin.kuesioner.pertanyaan.store', $kuesioner) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pertanyaan <span class="text-red-500">*</span></label>
                    <textarea name="pertanyaan" rows="3" required placeholder="Tuliskan teks pertanyaan di sini..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Kelompok / Kategori</label>
                    <input type="text" name="kelompok" placeholder="Misal: Pengalaman Belajar"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tipe Pertanyaan <span class="text-red-500">*</span></label>
                    <select name="tipe" id="tipe-pertanyaan" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
                        <option value="radio">Pilihan Ganda (Radio - 1 Jawaban)</option>
                        <option value="checkbox">Pilihan Jamak (Checkbox - Banyak Jawaban)</option>
                        <option value="select">Dropdown (Select)</option>
                        <option value="text">Teks Singkat (Text)</option>
                        <option value="textarea">Esai Panjang (Textarea)</option>
                    </select>
                </div>

                <div id="opsi-wrapper">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pilihan Jawaban</label>
                    <textarea name="opsi" rows="4" placeholder="Tulis satu pilihan per baris. Contoh:&#10;Sangat Puas&#10;Puas&#10;Cukup&#10;Kurang"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20] focus:bg-white transition"></textarea>
                    <p class="text-[11px] text-gray-400 mt-1">Pisahkan tiap opsi dengan baris baru (Enter).</p>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="wajib" value="1" checked class="rounded text-[#1B5E20] focus:ring-[#1B5E20] w-4 h-4">
                        <span class="text-xs font-medium text-gray-700">Wajib diisi</span>
                    </label>
                    <div>
                        <input type="number" name="urutan" placeholder="Urutan" class="w-16 bg-gray-50 border border-gray-200 rounded px-2 py-1 text-xs text-center">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1B5E20] text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-[#154a18] transition shadow-sm">
                    + Tambahkan Pertanyaan
                </button>
            </form>
        </div>
    </div>

    {{-- Daftar Pertanyaan --}}
    <div class="lg:col-span-2 space-y-4">
        @forelse ($pertanyaan as $p)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-50 text-[#1B5E20] text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                            {{ $loop->iteration }}
                        </span>
                        <div>
                            @if ($p->kelompok)
                                <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-green-700 bg-green-50 px-2 py-0.5 rounded mb-1">
                                    {{ $p->kelompok }}
                                </span>
                            @endif
                            <h3 class="text-sm font-semibold text-gray-800">{{ $p->pertanyaan }}</h3>
                            <div class="flex items-center gap-2 mt-1.5 text-xs text-gray-400">
                                <span class="capitalize font-medium text-gray-600">Tipe: {{ $p->tipe }}</span>
                                <span>•</span>
                                <span>{{ $p->wajib ? 'Wajib' : 'Opsional' }}</span>
                            </div>

                            @if (is_array($p->opsi) && count($p->opsi) > 0)
                                <div class="mt-3 flex flex-wrap gap-1.5">
                                    @foreach ($p->opsi as $o)
                                        <span class="text-xs bg-gray-50 border border-gray-200 text-gray-600 px-2 py-1 rounded">
                                            {{ $o }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.kuesioner.pertanyaan.destroy', [$kuesioner, $p]) }}" onsubmit="return confirm('Hapus pertanyaan ini?')" class="shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 hover:underline p-1">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm italic">Belum ada pertanyaan pada kuesioner ini.</p>
                <p class="text-xs text-gray-400 mt-1">Gunakan formulir di sebelah kiri untuk menambahkan pertanyaan pertama.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

