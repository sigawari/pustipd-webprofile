<!-- Modal Tambah FAQ -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative transform scale-95 transition-all duration-300">
        
        <!-- Header -->
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form -->
        <form id="addForm" method="POST" action="{{ route('admin.manage-content.faq.store') }}" class="space-y-4">
            @csrf

            <!-- Pertanyaan -->
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                <textarea name="question" id="question" rows="2" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tulis pertanyaan FAQ..."></textarea>
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jawaban -->
            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">Jawaban</label>
                <textarea name="answer" id="answer" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tulis jawaban lengkap..."></textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info -->
            <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg flex items-start">
                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-yellow-800">FAQ akan disimpan sebagai <strong>Draft</strong> dan belum tampil di halaman publik.</p>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeModal()"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan sebagai Draft
                </button>
            </div>
        </form>

        <!-- Tombol X -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>