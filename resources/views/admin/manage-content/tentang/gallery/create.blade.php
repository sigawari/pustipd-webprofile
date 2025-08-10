<!-- Modal Tambah Gallery -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl p-6 relative">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah Gallery</h2>

        <form id="addForm" method="POST" action="{{ route('admin.manage-content.tentang.gallery.store') }}" enctype="multipart/form-data" class="flex gap-6">
            @csrf

            <!-- Gambar -->
            <div class="flex flex-col items-center w-1/3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Preview Gambar</label>
                <div id="photo-preview" class="mb-3 hidden">
                    <img id="preview-img" src="" alt="Preview" class="w-48 h-48 object-cover rounded">
                </div>

                <div id="upload-icon" class="mb-3 flex items-center justify-center w-48 h-48 border-2 border-dashed border-gray-300 rounded bg-gray-50 text-gray-400">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                    Pilih Gambar
                </label>
                <input type="file" name="image" id="image" accept="image/*" required
                       onchange="previewImage(this)"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Input -->
            <div class="flex-1 space-y-4">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Gallery</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan judul gallery...">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event Date -->
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kegiatan</label>
                    <input type="date" name="event_date" id="event_date" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('event_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Hidden -->
                <input type="hidden" name="status" value="draft">

                <!-- Info untuk user -->
                <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-green-800">Gallery akan disimpan sebagai <strong>Draft</strong>. Publish secara manual untuk menampilkan.</p>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 pt-4">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700">
                        Simpan sebagai Draft
                    </button>
                </div>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
