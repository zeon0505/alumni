{{-- Modal Tambah Wirausaha --}}
<div id="modal-tambah-wirausaha" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h3 class="font-bold text-[#1B5E20]">Tambah Wirausaha</h3>
            <button onclick="closeModal('modal-tambah-wirausaha')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form method="POST" action="{{ route('wirausaha.store') }}" class="px-6 py-4 space-y-3">
            @csrf
            @include('karir.modals._wirausaha-fields')
            <div class="flex justify-end gap-3 pt-3">
                <button type="button" onclick="closeModal('modal-tambah-wirausaha')" class="text-sm px-4 py-2 border rounded text-gray-600 hover:bg-gray-50">Batal</button>
                <button type="submit" class="text-sm bg-[#1B5E20] text-white px-5 py-2 rounded hover:bg-[#154a18]">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Wirausaha --}}
<div id="modal-edit-wirausaha" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h3 class="font-bold text-[#1B5E20]">Edit Wirausaha</h3>
            <button onclick="closeModal('modal-edit-wirausaha')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="form-edit-wirausaha" method="POST" action="" class="px-6 py-4 space-y-3">
            @csrf @method('PUT')
            @include('karir.modals._wirausaha-fields')
            <div class="flex justify-end gap-3 pt-3">
                <button type="button" onclick="closeModal('modal-edit-wirausaha')" class="text-sm px-4 py-2 border rounded text-gray-600 hover:bg-gray-50">Batal</button>
                <button type="submit" class="text-sm bg-[#1B5E20] text-white px-5 py-2 rounded hover:bg-[#154a18]">Simpan</button>
            </div>
        </form>
    </div>
</div>
