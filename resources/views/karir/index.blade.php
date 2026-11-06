@extends('layouts.app')

@section('title', 'Perjalanan Karir')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="bg-[#1B5E20] text-white px-6 py-4 rounded-t-lg">
        <h1 class="text-lg font-bold">Perjalanan Karir</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">

        {{-- ── Riwayat Pekerjaan ─────────────────────────── --}}
        <div class="p-5">
            <h2 class="text-sm font-bold text-[#1B5E20] mb-4">Riwayat Pekerjaan</h2>

            @if ($alumni->riwayatPekerjaan->isEmpty())
                <p class="text-xs text-gray-400 italic mb-3">Belum ada data pekerjaan.</p>
            @endif

            <div class="space-y-3 mb-4">
                @foreach ($alumni->riwayatPekerjaan as $pekerjaan)
                    <div class="border border-gray-100 rounded-lg p-3 bg-gray-50 relative">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">SETELAH LULUS</div>
                        <p class="text-xs text-gray-500">
                            {{ $pekerjaan->tanggal_mulai->format('d M Y') }} –
                            {{ $pekerjaan->masih_bekerja ? 'Sekarang' : ($pekerjaan->tanggal_selesai?->format('d M Y') ?? '-') }}
                            @if ($pekerjaan->masih_bekerja)
                                <span class="text-green-600 font-medium">(Bekerja)</span>
                            @endif
                        </p>
                        <p class="font-bold text-sm text-[#1B5E20] mt-1">{{ $pekerjaan->jabatan }}</p>
                        <p class="text-sm text-gray-700">{{ $pekerjaan->nama_instansi }}</p>
                        @if ($pekerjaan->jenis_pekerjaan)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $pekerjaan->jenis_pekerjaan }}</p>
                        @endif

                        {{-- Actions --}}
                        <div class="flex gap-2 mt-2">
                            <button onclick="openEditPekerjaan({{ $pekerjaan->id }}, '{{ addslashes($pekerjaan->nama_instansi) }}', '{{ addslashes($pekerjaan->jabatan) }}', '{{ $pekerjaan->jenis_pekerjaan }}', '{{ $pekerjaan->tanggal_mulai->format('Y-m-d') }}', '{{ $pekerjaan->tanggal_selesai?->format('Y-m-d') }}', {{ $pekerjaan->masih_bekerja ? 'true' : 'false' }})"
                                class="text-xs text-blue-600 hover:underline flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </button>
                            <form method="POST" action="{{ route('pekerjaan.destroy', $pekerjaan) }}" onsubmit="return confirm('Hapus data pekerjaan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:underline flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-xs text-gray-400 mb-2">Pembaruan: {{ now()->format('d-m-Y H:i') }}</p>
            <button onclick="document.getElementById('modal-tambah-pekerjaan').classList.remove('hidden')"
                class="text-sm bg-[#1B5E20] hover:bg-[#154a18] text-white px-4 py-2 rounded transition font-medium">
                + Tambah Pekerjaan
            </button>
        </div>

        {{-- ── Riwayat Pendidikan ────────────────────────── --}}
        <div class="p-5">
            <h2 class="text-sm font-bold text-[#1B5E20] mb-4">Riwayat Pendidikan / Profesi</h2>

            @if ($alumni->riwayatPendidikan->isEmpty())
                <p class="text-xs text-gray-400 italic mb-3">Belum ada data pendidikan.</p>
            @endif

            <div class="space-y-3 mb-4">
                @foreach ($alumni->riwayatPendidikan as $pend)
                    <div class="border border-gray-100 rounded-lg p-3 bg-gray-50">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">SETELAH LULUS</div>
                        @if ($pend->belum_melanjutkan)
                            <p class="text-sm text-gray-500 italic">(Belum/Tidak Melanjutkan)</p>
                        @else
                            <p class="font-bold text-sm text-[#1B5E20]">{{ $pend->jenjang }} – {{ $pend->bidang_studi }}</p>
                            <p class="text-sm text-gray-700">{{ $pend->nama_institusi }}</p>
                            <p class="text-xs text-gray-400">
                                {{ $pend->tanggal_mulai?->format('d M Y') }} –
                                {{ $pend->masih_studi ? 'Sekarang' : ($pend->tanggal_selesai?->format('d M Y') ?? '-') }}
                            </p>
                        @endif
                        <div class="flex gap-2 mt-2">
                            <button onclick="openEditPendidikan({{ $pend->id }}, '{{ addslashes($pend->nama_institusi ?? '') }}', '{{ $pend->jenjang }}', '{{ addslashes($pend->bidang_studi ?? '') }}', '{{ $pend->tanggal_mulai?->format('Y-m-d') }}', '{{ $pend->tanggal_selesai?->format('Y-m-d') }}', {{ $pend->masih_studi ? 'true' : 'false' }}, {{ $pend->belum_melanjutkan ? 'true' : 'false' }})"
                                class="text-xs text-blue-600 hover:underline">Edit</button>
                            <form method="POST" action="{{ route('pendidikan.destroy', $pend) }}" onsubmit="return confirm('Hapus data pendidikan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-xs text-gray-400 mb-2">Pembaruan: {{ now()->format('d-m-Y H:i') }}</p>
            <button onclick="document.getElementById('modal-tambah-pendidikan').classList.remove('hidden')"
                class="text-sm bg-[#1B5E20] hover:bg-[#154a18] text-white px-4 py-2 rounded transition font-medium">
                + Tambah Pendidikan
            </button>
        </div>

        {{-- ── Riwayat Wirausaha ─────────────────────────── --}}
        <div class="p-5">
            <h2 class="text-sm font-bold text-[#1B5E20] mb-4">Riwayat Wirausaha</h2>

            @if ($alumni->riwayatWirausaha->isEmpty())
                <p class="text-xs text-gray-400 italic mb-3">Belum ada data wirausaha.</p>
            @endif

            <div class="space-y-3 mb-4">
                @foreach ($alumni->riwayatWirausaha as $wira)
                    <div class="border border-gray-100 rounded-lg p-3 bg-gray-50">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">SETELAH LULUS</div>
                        <p class="font-bold text-sm text-[#1B5E20]">{{ $wira->nama_usaha }}</p>
                        @if ($wira->jenis_usaha)
                            <p class="text-xs text-gray-500">{{ $wira->jenis_usaha }}</p>
                        @endif
                        <p class="text-xs text-gray-400">
                            {{ $wira->tanggal_mulai->format('d M Y') }} –
                            {{ $wira->masih_berjalan ? 'Sekarang' : ($wira->tanggal_selesai?->format('d M Y') ?? '-') }}
                        </p>
                        <div class="flex gap-2 mt-2">
                            <button onclick="openEditWirausaha({{ $wira->id }}, '{{ addslashes($wira->nama_usaha) }}', '{{ addslashes($wira->jenis_usaha ?? '') }}', '{{ addslashes($wira->deskripsi ?? '') }}', '{{ $wira->tanggal_mulai->format('Y-m-d') }}', '{{ $wira->tanggal_selesai?->format('Y-m-d') }}', {{ $wira->masih_berjalan ? 'true' : 'false' }})"
                                class="text-xs text-blue-600 hover:underline">Edit</button>
                            <form method="POST" action="{{ route('wirausaha.destroy', $wira) }}" onsubmit="return confirm('Hapus data wirausaha ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-xs text-gray-400 mb-2">Pembaruan: {{ now()->format('d-m-Y H:i') }}</p>
            <button onclick="document.getElementById('modal-tambah-wirausaha').classList.remove('hidden')"
                class="text-sm bg-[#1B5E20] hover:bg-[#154a18] text-white px-4 py-2 rounded transition font-medium">
                + Tambah Wirausaha
            </button>
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
