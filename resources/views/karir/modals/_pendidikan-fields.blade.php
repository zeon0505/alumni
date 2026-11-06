<div>
    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
        <input type="checkbox" name="belum_melanjutkan" value="1" class="rounded">
        Belum / Tidak Melanjutkan Pendidikan
    </label>
</div>
<div>
    <label class="block text-sm text-gray-600 mb-1">Nama Institusi</label>
    <input type="text" name="nama_institusi" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
</div>
<div>
    <label class="block text-sm text-gray-600 mb-1">Jenjang</label>
    <select name="jenjang" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
        <option value="">-- Pilih --</option>
        @foreach (['D3', 'D4', 'S1', 'S2', 'S3', 'Profesi', 'Sertifikasi'] as $j)
            <option value="{{ $j }}">{{ $j }}</option>
        @endforeach
    </select>
</div>
<div>
    <label class="block text-sm text-gray-600 mb-1">Bidang Studi / Jurusan</label>
    <input type="text" name="bidang_studi" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
</div>
<div class="grid grid-cols-2 gap-3">
    <div>
        <label class="block text-sm text-gray-600 mb-1">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
    </div>
</div>
<div>
    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
        <input type="checkbox" name="masih_studi" value="1" class="rounded">
        Masih Studi / Aktif
    </label>
</div>
