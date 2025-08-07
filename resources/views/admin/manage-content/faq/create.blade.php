<!-- Modal Tambah FAQ -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <h2 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah {{ $title }}</h2>

        <form id="addForm" method="POST" action="{{ route('admin.manage-content.faq.store') }}">
            @csrf

            <!-- Pertanyaan -->
            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan</label>
                <textarea name="question" id="question" rows="2" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis pertanyaan FAQ..."></textarea>
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jawaban -->
            <div class="mb-4">
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Jawaban</label>
                <textarea name="answer" id="answer" rows="4" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis jawaban lengkap..."></textarea>
                @error('answer')
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
                    <p class="text-sm text-yellow-800">FAQ akan disimpan sebagai <strong>Draft</strong> dan belum tampil
                        di halaman publik.</p>
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
