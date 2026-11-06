@extends('layouts.app')

@section('title', 'Isi Kuisioner')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="bg-[#1B5E20] text-white px-6 py-4 rounded-t-lg">
        <h1 class="text-lg font-bold">{{ $kuesioner->judul }}</h1>
    </div>

    <div class="p-6">
        {{-- Steps --}}
        <div class="flex items-center mb-6">
            <div id="step-indicator-1" class="flex items-center gap-2 text-sm font-semibold text-white bg-[#1B5E20] px-4 py-1.5 rounded-l-full">
                <span class="w-5 h-5 bg-white text-[#1B5E20] rounded-full text-xs flex items-center justify-center font-bold">1</span>
                Bagian 1
            </div>
            <div id="step-indicator-2" class="flex items-center gap-2 text-sm font-medium text-gray-500 bg-gray-100 px-4 py-1.5 rounded-r-full">
                <span class="w-5 h-5 bg-gray-300 text-white rounded-full text-xs flex items-center justify-center font-bold">2</span>
                Konfirmasi
            </div>
        </div>

        <form method="POST" action="{{ route('kuisioner.submit') }}" id="form-kuisioner">
            @csrf

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Bagian 1 --}}
            <div id="bagian-1">
                <h2 class="text-base font-bold text-[#1B5E20] mb-4">Pengalaman Belajar dan Pembentukan Karakter</h2>

                @php
                    $aspek = [
                        'perkuliahan'              => 'Perkuliahan',
                        'demonstrasi'              => 'Demonstrasi',
                        'partisipasi_mahasiswa'    => 'Partisipasi Mahasiswa dalam Proyek Riset',
                        'magang'                   => 'Magang',
                        'interaksi_dosen'          => 'Interaksi dengan Dosen',
                        'diskusi'                  => 'Diskusi dan Presentasi',
                        'praktikum'                => 'Praktikum/Praktek Lapangan',
                        'kerja_sosial'             => 'Kerja Sosial/Sukarela',
                        'ekstrakulikuler'          => 'Kegiatan Ekstrakulikuler',
                        'kursus_bahasa'            => 'Kursus Bahasa',
                        'pelatihan_kompetensi'     => 'Pelatihan Kompetensi (IT, Bisnis, dll.)',
                    ];
                    $skala = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang Baik'];
                @endphp

                <p class="text-sm text-gray-600 mb-3">
                    1. Menurut Anda seberapa besar penekanan pada aspek-aspek pembelajaran di bawah ini dilaksanakan di program studi Anda?
                </p>

                <div class="space-y-4">
                    @foreach ($aspek as $key => $label)
                        <div class="border border-gray-100 rounded-lg p-4 bg-gray-50">
                            <p class="text-sm font-medium text-gray-700 mb-2">&bull; {{ $label }}</p>
                            <div class="flex flex-wrap gap-x-6 gap-y-1">
                                @foreach ($skala as $s)
                                    <label class="flex items-center gap-1.5 text-sm text-gray-600 cursor-pointer">
                                        <input type="radio" name="jawaban[{{ $key }}]" value="{{ $s }}"
                                               class="text-[#1B5E20]"
                                               {{ old("jawaban.$key") === $s ? 'checked' : '' }}>
                                        {{ $s }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" onclick="showKonfirmasi()" class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-6 py-2.5 rounded transition">
                        Lanjut ke Konfirmasi &rarr;
                    </button>
                </div>
            </div>

            {{-- Bagian 2: Konfirmasi --}}
            <div id="bagian-2" class="hidden">
                <h2 class="text-base font-bold text-[#1B5E20] mb-4">Konfirmasi Jawaban Anda</h2>
                <div id="ringkasan-jawaban" class="space-y-2 mb-6 text-sm text-gray-700 bg-gray-50 border rounded-lg p-4">
                    {{-- Diisi via JS --}}
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="showBagian1()" class="text-sm px-5 py-2.5 border rounded text-gray-600 hover:bg-gray-50">
                        &larr; Kembali
                    </button>
                    <button type="submit" class="bg-[#1B5E20] hover:bg-[#154a18] text-white text-sm font-semibold px-6 py-2.5 rounded transition">
                        Submit Kuesioner
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
const aspekLabels = @json($aspek);

function showKonfirmasi() {
    const form  = document.getElementById('form-kuisioner');
    const radios = form.querySelectorAll('input[type="radio"]:checked');
    const selected = {};
    radios.forEach(r => {
        const key = r.name.replace('jawaban[', '').replace(']', '');
        selected[key] = r.value;
    });

    // Validasi semua aspek dijawab
    const allKeys = Object.keys(aspekLabels);
    const missing = allKeys.filter(k => !selected[k]);
    if (missing.length > 0) {
        alert('Mohon jawab semua pertanyaan sebelum melanjutkan.');
        return;
    }

    // Isi ringkasan
    const container = document.getElementById('ringkasan-jawaban');
    container.innerHTML = '<p class="font-semibold text-gray-700 mb-2">Penekanan aspek pembelajaran:</p>';
    allKeys.forEach(k => {
        const div = document.createElement('div');
        div.className = 'flex justify-between py-1 border-b border-gray-100';
        div.innerHTML = `<span>${aspekLabels[k]}</span><span class="font-medium text-[#1B5E20]">${selected[k]}</span>`;
        container.appendChild(div);
    });

    document.getElementById('bagian-1').classList.add('hidden');
    document.getElementById('bagian-2').classList.remove('hidden');

    // Update step indicator
    document.getElementById('step-indicator-1').classList.replace('bg-[#1B5E20]', 'bg-gray-100');
    document.getElementById('step-indicator-1').classList.replace('text-white', 'text-gray-500');
    document.getElementById('step-indicator-2').classList.replace('bg-gray-100', 'bg-[#1B5E20]');
    document.getElementById('step-indicator-2').classList.replace('text-gray-500', 'text-white');
}

function showBagian1() {
    document.getElementById('bagian-1').classList.remove('hidden');
    document.getElementById('bagian-2').classList.add('hidden');

    document.getElementById('step-indicator-1').classList.replace('bg-gray-100', 'bg-[#1B5E20]');
    document.getElementById('step-indicator-1').classList.replace('text-gray-500', 'text-white');
    document.getElementById('step-indicator-2').classList.replace('bg-[#1B5E20]', 'bg-gray-100');
    document.getElementById('step-indicator-2').classList.replace('text-white', 'text-gray-500');
}
</script>
@endsection
