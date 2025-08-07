<!-- Modal Tambah Ketetapan -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative max-h-[90vh] overflow-y-auto">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah {{ $title }}</h2>

        <form id="addForm" method="POST" action="{{ route('admin.manage-content.dokumen.ketetapan.store') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Judul Ketetapan -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Ketetapan</label>
                <input type="text" name="title" id="title" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan judul ketetapan...">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis deskripsi ketetapan..."></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX. Maksimal 10MB</p>
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tahun Terbit -->
            <div class="mb-4">
                <label for="year_published" class="block text-sm font-medium text-gray-700 mb-2">
                    Tahun Terbit <span class="text-gray-500 text-xs">(opsional)</span>
                </label>
                <input type="number" name="year_published" id="year_published" min="1900" max="{{ date('Y') + 1 }}"
                    value="{{ date('Y') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="{{ date('Y') }}">
                @error('year_published')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status (Hidden - Default Draft) -->
            <input type="hidden" name="status" value="draft">

            <!-- Info untuk user -->
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-blue-800">Ketetapan akan disimpan sebagai <strong>Draft</strong> dan belum
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
    function openAddModal() {
        document.getElementById('AddModal').classList.remove('hidden');
        document.getElementById('AddModal').classList.add('flex');

        // Reset form
        document.getElementById('addForm').reset();

        // Set default year
        document.getElementById('year_published').value = new Date().getFullYear();
    }

    function closeAddModal() {
        document.getElementById('AddModal').classList.add('hidden');
        document.getElementById('AddModal').classList.remove('flex');
    }

    // Close modal when clicking outside
    document.getElementById('AddModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddModal();
        }
    });
</script>
