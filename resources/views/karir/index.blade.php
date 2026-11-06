@extends('layouts.app')

@section('title', 'Perjalanan Karir')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Title --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm text-slate-500 hover:text-[#1B5E20] inline-flex items-center gap-1 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Profil
        </a>
        <span class="text-slate-300">/</span>
        <span class="text-xs sm:text-sm text-slate-700 font-semibold">Perjalanan Karir</span>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-slate-50/50">
            <h1 class="text-lg sm:text-xl font-bold text-slate-800">Perjalanan Karir Alumni</h1>
            <p class="text-xs text-slate-500 mt-0.5">Catatan riwayat pekerjaan, kelanjutan studi, dan wirausaha setelah lulus dari STAIMAS</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">

            {{-- ── Riwayat Pekerjaan ─────────────────────────── --}}
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <h2 class="text-sm font-bold text-slate-800">Riwayat Pekerjaan</h2>
                    </div>
                    <button onclick="document.getElementById('modal-tambah-pekerjaan').classList.remove('hidden')"
                        class="text-xs bg-emerald-50 hover:bg-emerald-100 text-[#1B5E20] border border-emerald-200/80 px-2.5 py-1.5 rounded-lg font-semibold transition">
                        + Tambah
                    </button>
                </div>

                @if ($alumni->riwayatPekerjaan->isEmpty())
                    <div class="py-8 text-center text-slate-400">
                        <p class="text-xs italic">Belum ada data pekerjaan.</p>
                    </div>
                @endif

                <div class="space-y-3">
                    @foreach ($alumni->riwayatPekerjaan as $pekerjaan)
                        <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50/70 hover:bg-slate-50 transition">
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1">
                                <span class="uppercase font-semibold tracking-wider text-[#1B5E20]">Setelah Lulus</span>
                                <span>
                                    {{ $pekerjaan->tanggal_mulai->format('d M Y') }} –
                                    {{ $pekerjaan->masih_bekerja ? 'Sekarang' : ($pekerjaan->tanggal_selesai?->format('d M Y') ?? '-') }}
                                </span>
                            </div>
                            <p class="font-bold text-sm text-slate-800">{{ $pekerjaan->jabatan }}</p>
                            <p class="text-xs text-slate-600 font-medium">{{ $pekerjaan->nama_instansi }}</p>
                            @if ($pekerjaan->jenis_pekerjaan)
                                <p class="text-[11px] text-slate-400 mt-0.5">{{ $pekerjaan->jenis_pekerjaan }}</p>
                            @endif

                            {{-- Actions --}}
                            <div class="flex items-center gap-3 mt-3 pt-2 border-t border-slate-200/60 text-xs">
                                <button onclick="openEditPekerjaan({{ $pekerjaan->id }}, '{{ addslashes($pekerjaan->nama_instansi) }}', '{{ addslashes($pekerjaan->jabatan) }}', '{{ $pekerjaan->jenis_pekerjaan }}', '{{ $pekerjaan->tanggal_mulai->format('Y-m-d') }}', '{{ $pekerjaan->tanggal_selesai?->format('Y-m-d') }}', {{ $pekerjaan->masih_bekerja ? 'true' : 'false' }})"
                                    class="text-blue-600 hover:underline font-medium">
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('pekerjaan.destroy', $pekerjaan) }}" onsubmit="return confirm('Hapus data pekerjaan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ── Riwayat Pendidikan ────────────────────────── --}}
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                        </span>
                        <h2 class="text-sm font-bold text-slate-800">Pendidikan Lanjutan</h2>
                    </div>
                    <button onclick="document.getElementById('modal-tambah-pendidikan').classList.remove('hidden')"
                        class="text-xs bg-emerald-50 hover:bg-emerald-100 text-[#1B5E20] border border-emerald-200/80 px-2.5 py-1.5 rounded-lg font-semibold transition">
                        + Tambah
                    </button>
                </div>

                @if ($alumni->riwayatPendidikan->isEmpty())
                    <div class="py-8 text-center text-slate-400">
                        <p class="text-xs italic">Belum ada data studi lanjutan.</p>
                    </div>
                @endif

                <div class="space-y-3">
                    @foreach ($alumni->riwayatPendidikan as $pend)
                        <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50/70 hover:bg-slate-50 transition">
                            <div class="text-[11px] text-slate-400 uppercase tracking-wider mb-1 font-semibold text-[#1B5E20]">Studi Lanjutan</div>
                            @if ($pend->belum_melanjutkan)
                                <p class="text-xs text-slate-500 italic">(Belum/Tidak Melanjutkan)</p>
                            @else
                                <p class="font-bold text-sm text-slate-800">{{ $pend->jenjang }} – {{ $pend->bidang_studi }}</p>
                                <p class="text-xs text-slate-600 font-medium">{{ $pend->nama_institusi }}</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ $pend->tanggal_mulai?->format('d M Y') }} –
                                    {{ $pend->masih_studi ? 'Sekarang' : ($pend->tanggal_selesai?->format('d M Y') ?? '-') }}
                                </p>
                            @endif
                            <div class="flex items-center gap-3 mt-3 pt-2 border-t border-slate-200/60 text-xs">
                                <button onclick="openEditPendidikan({{ $pend->id }}, '{{ addslashes($pend->nama_institusi ?? '') }}', '{{ $pend->jenjang }}', '{{ addslashes($pend->bidang_studi ?? '') }}', '{{ $pend->tanggal_mulai?->format('Y-m-d') }}', '{{ $pend->tanggal_selesai?->format('Y-m-d') }}', {{ $pend->masih_studi ? 'true' : 'false' }}, {{ $pend->belum_melanjutkan ? 'true' : 'false' }})"
                                    class="text-blue-600 hover:underline font-medium">Edit</button>
                                <form method="POST" action="{{ route('pendidikan.destroy', $pend) }}" onsubmit="return confirm('Hapus data pendidikan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ── Riwayat Wirausaha ─────────────────────────── --}}
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-emerald-50 text-[#1B5E20] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </span>
                        <h2 class="text-sm font-bold text-slate-800">Usaha / Bisnis</h2>
                    </div>
                    <button onclick="document.getElementById('modal-tambah-wirausaha').classList.remove('hidden')"
                        class="text-xs bg-emerald-50 hover:bg-emerald-100 text-[#1B5E20] border border-emerald-200/80 px-2.5 py-1.5 rounded-lg font-semibold transition">
                        + Tambah
                    </button>
                </div>

                @if ($alumni->riwayatWirausaha->isEmpty())
                    <div class="py-8 text-center text-slate-400">
                        <p class="text-xs italic">Belum ada data wirausaha.</p>
                    </div>
                @endif

                <div class="space-y-3">
                    @foreach ($alumni->riwayatWirausaha as $wira)
                        <div class="border border-slate-100 rounded-xl p-3.5 bg-slate-50/70 hover:bg-slate-50 transition">
                            <div class="text-[11px] text-slate-400 uppercase tracking-wider mb-1 font-semibold text-[#1B5E20]">Kewirausahaan</div>
                            <p class="font-bold text-sm text-slate-800">{{ $wira->nama_usaha }}</p>
                            @if ($wira->jenis_usaha)
                                <p class="text-xs text-slate-600 font-medium">{{ $wira->jenis_usaha }}</p>
                            @endif
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                {{ $wira->tanggal_mulai->format('d M Y') }} –
                                {{ $wira->masih_berjalan ? 'Sekarang' : ($wira->tanggal_selesai?->format('d M Y') ?? '-') }}
                            </p>
                            <div class="flex items-center gap-3 mt-3 pt-2 border-t border-slate-200/60 text-xs">
                                <button onclick="openEditWirausaha({{ $wira->id }}, '{{ addslashes($wira->nama_usaha) }}', '{{ addslashes($wira->jenis_usaha ?? '') }}', '{{ addslashes($wira->deskripsi ?? '') }}', '{{ $wira->tanggal_mulai->format('Y-m-d') }}', '{{ $wira->tanggal_selesai?->format('Y-m-d') }}', {{ $wira->masih_berjalan ? 'true' : 'false' }})"
                                    class="text-blue-600 hover:underline font-medium">Edit</button>
                                <form method="POST" action="{{ route('wirausaha.destroy', $wira) }}" onsubmit="return confirm('Hapus data wirausaha ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ═══════════════ MODALS ═══════════════ --}}
@include('karir.modals.pekerjaan')
@include('karir.modals.pendidikan')
@include('karir.modals.wirausaha')

<script>
// Pekerjaan
function openEditPekerjaan(id, instansi, jabatan, jenis, mulai, selesai, masih) {
    const f = document.getElementById('form-edit-pekerjaan');
    f.action = `/pekerjaan/${id}`;
    f.querySelector('[name="nama_instansi"]').value = instansi;
    f.querySelector('[name="jabatan"]').value = jabatan;
    f.querySelector('[name="jenis_pekerjaan"]').value = jenis;
    f.querySelector('[name="tanggal_mulai"]').value = mulai;
    f.querySelector('[name="tanggal_selesai"]').value = selesai || '';
    f.querySelector('[name="masih_bekerja"]').checked = masih;
    document.getElementById('modal-edit-pekerjaan').classList.remove('hidden');
}

// Pendidikan
function openEditPendidikan(id, institusi, jenjang, bidang, mulai, selesai, masih, belum) {
    const f = document.getElementById('form-edit-pendidikan');
    f.action = `/pendidikan/${id}`;
    f.querySelector('[name="nama_institusi"]').value = institusi;
    f.querySelector('[name="jenjang"]').value = jenjang;
    f.querySelector('[name="bidang_studi"]').value = bidang;
    f.querySelector('[name="tanggal_mulai"]').value = mulai || '';
    f.querySelector('[name="tanggal_selesai"]').value = selesai || '';
    f.querySelector('[name="masih_studi"]').checked = masih;
    f.querySelector('[name="belum_melanjutkan"]').checked = belum;
    document.getElementById('modal-edit-pendidikan').classList.remove('hidden');
}

// Wirausaha
function openEditWirausaha(id, nama, jenis, desc, mulai, selesai, masih) {
    const f = document.getElementById('form-edit-wirausaha');
    f.action = `/wirausaha/${id}`;
    f.querySelector('[name="nama_usaha"]').value = nama;
    f.querySelector('[name="jenis_usaha"]').value = jenis;
    f.querySelector('[name="deskripsi"]').value = desc;
    f.querySelector('[name="tanggal_mulai"]').value = mulai;
    f.querySelector('[name="tanggal_selesai"]').value = selesai || '';
    f.querySelector('[name="masih_berjalan"]').checked = masih;
    document.getElementById('modal-edit-wirausaha').classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>
@endsection
