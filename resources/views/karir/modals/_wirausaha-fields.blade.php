<div>
    <label class="block text-sm text-gray-600 mb-1">Nama Usaha <span class="text-red-500">*</span></label>
    <input type="text" name="nama_usaha" required class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
</div>
<div>
    <label class="block text-sm text-gray-600 mb-1">Jenis Usaha</label>
    <input type="text" name="jenis_usaha" placeholder="Kuliner, Teknologi, Jasa, dll." class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
</div>
<div>
    <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
    <textarea name="deskripsi" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]"></textarea>
</div>
<div class="grid grid-cols-2 gap-3">
    <div>
        <label class="block text-sm text-gray-600 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
        <input type="date" name="tanggal_mulai" required class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="w-full bg-gray-50 border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B5E20]">
    </div>
</div>
<div>
    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
        <input type="checkbox" name="masih_berjalan" value="1" class="rounded">
        Usaha Masih Berjalan
    </label>
</div>
