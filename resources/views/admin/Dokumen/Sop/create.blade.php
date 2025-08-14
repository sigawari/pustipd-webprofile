<!-- Modal Tambah SOP -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white rounded-xl shadow-lg p-6">

        <!-- Judul Modal -->
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">
            Tambah {{ $title }}
        </h2>

        <!-- Form -->
        <form id="addForm" method="POST" action="{{ route('admin.dokumen.sop.store') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Judul SOP -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul
                    {{ $title }}</label>
                <input type="text" name="title" id="title" required placeholder="Masukkan judul SOP..."
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" required placeholder="Tulis deskripsi SOP..."
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maksimal 10MB</p>
                @error('file')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tahun Terbit -->
            <div class="mb-4">
                <label for="year_published" class="block text-sm font-medium text-gray-700 mb-2">
                    Tahun Terbit <span class="text-gray-500 text-xs">(opsional)</span>
                </label>
                <input type="number" name="year_published" id="year_published" min="1900" max="{{ date('Y') + 1 }}"
                    value="{{ date('Y') }}" placeholder="{{ date('Y') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('year_published')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status (Hidden - Default Draft) -->
            <input type="hidden" name="status" value="draft">

            <!-- Info untuk user -->
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01
                               M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-blue-800">
                        SOP akan disimpan sebagai <strong>Draft</strong> dan belum tampil di halaman publik.
                    </p>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                    <!-- Icon X -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                    <!-- Icon Save -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
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
