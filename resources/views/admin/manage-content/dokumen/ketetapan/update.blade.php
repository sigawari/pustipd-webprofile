<!-- Modal Edit Ketetapan -->
<div id="UpdateModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative max-h-[90vh] overflow-y-auto">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Ketetapan -->
            <div class="mb-4">
                <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-2">Judul Ketetapan</label>
                <input type="text" name="title" id="edit_title" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="edit_description" rows="4" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload (Opsional untuk Edit) -->
            <div class="mb-4">
                <label for="edit_file" class="block text-sm font-medium text-gray-700 mb-2">File Dokumen <span
                        class="text-gray-500 text-xs">(kosongkan jika tidak ingin mengganti)</span></label>

                <!-- Current file info -->
                <div id="currentFileInfo" class="mb-2 p-2 bg-gray-50 rounded-lg text-sm hidden">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>File saat ini: <span id="currentFileName"></span></span>
                    </div>
                </div>

                <input type="file" name="file" id="edit_file" accept=".pdf,.doc,.docx"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX. Maksimal 10MB</p>
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tahun Terbit -->
            <div class="mb-4">
                <label for="edit_year_published" class="block text-sm font-medium text-gray-700 mb-2">Tahun
                    Terbit</label>
                <input type="number" name="year_published" id="edit_year_published" min="1900"
                    max="{{ date('Y') + 1 }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('year_published')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="edit_status" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeUpdateModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeUpdateModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    function openUpdateModal(id) {
        // Fetch data via AJAX
        fetch(`/admin/manage-content/dokumen/ketetapan/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const ketetapan = data.ketetapan;

                // Update form action
                document.getElementById('updateForm').action =
                    `/admin/manage-content/dokumen/ketetapan/${ketetapan.id}`;

                // Fill form data
                document.getElementById('edit_title').value = ketetapan.title || '';
                document.getElementById('edit_description').value = ketetapan.description || '';
                document.getElementById('edit_year_published').value = ketetapan.year_published || '';
                document.getElementById('edit_sort_order').value = ketetapan.sort_order || 0;
                document.getElementById('edit_status').value = ketetapan.status || 'draft';

                // Show current file info if exists
                if (ketetapan.original_filename) {
                    document.getElementById('currentFileInfo').classList.remove('hidden');
                    document.getElementById('currentFileName').textContent = ketetapan.original_filename;
                } else {
                    document.getElementById('currentFileInfo').classList.add('hidden');
                }

                // Show modal
                document.getElementById('UpdateModal').classList.remove('hidden');
                document.getElementById('UpdateModal').classList.add('flex');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data');
            });
    }

    function closeUpdateModal() {
        document.getElementById('UpdateModal').classList.add('hidden');
        document.getElementById('UpdateModal').classList.remove('flex');
    }

    // Close modal when clicking outside
    document.getElementById('UpdateModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeUpdateModal();
        }
    });
</script>
