<!-- Modal Tambah Gallery -->
<div id="galleryModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah {{ $title }}</h2>

        <form id="galleryForm" method="POST" action="{{ route('admin.manage-content.tentang.gallery.store') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Preview Gambar -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar</label>
                <div id="imagePreview"
                    class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hidden">
                    <img id="previewImg" src="" alt="Preview"
                        class="max-w-full max-h-full object-contain rounded-lg">
                </div>
                <div id="placeholderPreview"
                    class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center bg-gray-50">
                    <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm">Upload gambar untuk melihat preview</p>
                </div>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar <span class="text-red-500">*</span>
                </label>
                <input type="file" name="image" id="image" accept="image/*" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">
                    Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
                </p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan judul gallery...">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan deskripsi gallery..."></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Kegiatan -->
            <div class="mb-4">
                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="date" name="event_date" id="event_date" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('event_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div class="mb-4">
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan Tampil <span class="text-gray-500 text-xs">(opsional)</span>
                </label>
                <input type="number" name="sort_order" id="sort_order" min="1"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Kosongkan untuk urutan otomatis">
                <p class="text-xs text-gray-500 mt-1">
                    Jika kosong, akan diisi otomatis dengan nomor urutan berikutnya
                </p>
                @error('sort_order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status (Hidden - Default Draft) -->
            <input type="hidden" name="status" value="draft">

            <!-- Info untuk user -->
            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-yellow-800">Gallery akan disimpan sebagai <strong>Draft</strong> dan belum
                        tampil di halaman publik.</p>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan sebagai Draft
                </button>
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

<script>
    // Modal functions
    function openAddModal() {
        document.getElementById('galleryModal').classList.remove('hidden');
        document.getElementById('galleryModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeAddModal() {
        document.getElementById('galleryModal').classList.add('hidden');
        document.getElementById('galleryModal').classList.remove('flex');
        document.body.style.overflow = 'auto';

        // Reset form
        document.getElementById('galleryForm').reset();
        resetImagePreview();
    }

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('placeholderPreview').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            resetImagePreview();
        }
    });

    function resetImagePreview() {
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('placeholderPreview').classList.remove('hidden');
        document.getElementById('previewImg').src = '';
    }

    // Close modal when clicking backdrop
    document.getElementById('galleryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('galleryModal').classList.contains('hidden')) {
            closeAddModal();
        }
    });
</script>
