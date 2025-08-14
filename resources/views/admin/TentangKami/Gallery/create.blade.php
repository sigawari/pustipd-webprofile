<!-- Modal Tambah Gallery -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl mx-auto p-4 sm:p-6 relative max-h-[90vh] overflow-y-auto">
        <h2 id="modalTitle" class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Tambah Gallery</h2>

        <form id="addForm" method="POST" action="{{ route('admin.tentang-kami.gallery.store') }}"
            enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Layout Wrapper: Mobile Stack, Desktop Side-by-side -->
            <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">

                <!-- Form Input Section - Order 1 di mobile dan desktop -->
                <div class="flex-1 space-y-4 order-1">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Gallery</label>
                        <input type="text" name="title" id="title" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Masukkan judul gallery...">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Kegiatan</label>
                        <input type="date" name="event_date" id="event_date" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        @error('event_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload Section - Order 2 di mobile dan desktop -->
                <div class="flex flex-col items-center w-full lg:w-2/5 order-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar</label>

                    <!-- Preview Image -->
                    <div id="photo-preview" class="mb-3 hidden">
                        <img id="preview-img" src="" alt="Preview"
                            class="w-full max-w-40 h-40 object-cover rounded-lg">
                    </div>

                    <!-- Upload Placeholder -->
                    <div id="upload-icon"
                        class="mb-3 flex items-center justify-center w-full max-w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 text-gray-400 hover:border-gray-400 transition-colors">
                        <div class="text-center">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-xs text-gray-500">Klik tombol di bawah untuk upload</p>
                        </div>
                    </div>

                    <!-- File Input -->
                    <div class="w-full max-w-40">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Gambar
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" required
                            onchange="previewImage(this)"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm file:mr-4 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 mt-2 text-center">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status Hidden -->
            <input type="hidden" name="status" value="draft">

            <!-- Info untuk user -->
            <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-start sm:items-center">
                    <svg class="w-4 h-4 text-green-600 mr-2 mt-0.5 sm:mt-0 flex-shrink-0" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xs sm:text-sm text-green-800">Gallery akan disimpan sebagai
                        <strong>Draft</strong>. Publish secara manual untuk menampilkan.
                    </p>
                </div>
            </div>

            <!-- Tombol Action - Selalu di bawah untuk mobile dan desktop -->
            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeAddModal()"
                    class="w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan sebagai Draft
                </button>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
