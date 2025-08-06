<!-- Modal Edit Gallery -->
@foreach ($galleries as $gallery)
    <div id="UpdateModal-{{ $gallery->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

            <form method="POST" action="{{ route('admin.manage-content.tentang.gallery.update', $gallery->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Preview Gambar Current -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    <div
                        class="w-full h-48 border border-gray-200 rounded-lg flex items-center justify-center bg-gray-50">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="max-w-full max-h-full object-contain rounded-lg">
                        @else
                            <div class="text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p>Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Preview Gambar Baru -->
                <div class="mb-4">
                    <div id="newImagePreview-{{ $gallery->id }}"
                        class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg items-center justify-center bg-gray-50 hidden">
                        <img id="newPreviewImg-{{ $gallery->id }}" src="" alt="New Preview"
                            class="max-w-full max-h-full object-contain rounded-lg">
                    </div>
                </div>

                <!-- Upload Gambar Baru -->
                <div class="mb-4">
                    <label for="image-{{ $gallery->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Ganti Gambar <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <input type="file" name="image" id="image-{{ $gallery->id }}" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.
                    </p>
                </div>

                <!-- Judul -->
                <div class="mb-4">
                    <label for="title-{{ $gallery->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title-{{ $gallery->id }}" required
                        value="{{ $gallery->title }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="description-{{ $gallery->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description-{{ $gallery->id }}" rows="3"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $gallery->description }}</textarea>
                </div>

                <!-- Tanggal Kegiatan -->
                <div class="mb-4">
                    <label for="event_date-{{ $gallery->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="event_date" id="event_date-{{ $gallery->id }}" required
                        value="{{ $gallery->event_date ? $gallery->event_date->format('Y-m-d') : '' }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Urutan -->
                <div class="mb-4">
                    <label for="sort_order-{{ $gallery->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order-{{ $gallery->id }}" min="0"
                        value="{{ $gallery->sort_order }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status-{{ $gallery->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status-{{ $gallery->id }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="draft" {{ $gallery->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $gallery->status == 'published' ? 'selected' : '' }}>Published
                        </option>
                        <option value="archived" {{ $gallery->status == 'archived' ? 'selected' : '' }}>Archived
                        </option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $gallery->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $gallery->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Image preview for update modal {{ $gallery->id }}
        document.getElementById('image-{{ $gallery->id }}').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('newImagePreview-{{ $gallery->id }}');
            const previewImg = document.getElementById('newPreviewImg-{{ $gallery->id }}');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.classList.add('flex');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                preview.classList.remove('flex');
                previewImg.src = '';
            }
        });
    </script>
@endforeach

<script>
    // Update modal functions
    function openUpdateModal(id) {
        document.getElementById('UpdateModal-' + id).classList.remove('hidden');
        document.getElementById('UpdateModal-' + id).classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeUpdateModal(id) {
        document.getElementById('UpdateModal-' + id).classList.add('hidden');
        document.getElementById('UpdateModal-' + id).classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking backdrop
    document.querySelectorAll('[id^="UpdateModal-"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                const id = this.id.replace('UpdateModal-', '');
                closeUpdateModal(id);
            }
        });
    });
</script>
