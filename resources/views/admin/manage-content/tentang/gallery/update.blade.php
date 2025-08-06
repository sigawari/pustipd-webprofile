<!-- Modal Edit FAQ -->
@foreach ($faqs as $faq)
    <div id="UpdateModal-{{ $faq->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit {{ $title }}</h2>

            <form method="POST" action="{{ route('admin.manage-content.faq.update', $faq->id) }}">
                @csrf
                @method('PUT')

                <!-- Pertanyaan -->
                <div class="mb-4">
                    <label for="question-{{ $faq->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan</label>
                    <textarea name="question" id="question-{{ $faq->id }}" rows="2" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $faq->question }}</textarea>
                </div>

                <!-- Jawaban -->
                <div class="mb-4">
                    <label for="answer-{{ $faq->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Jawaban</label>
                    <textarea name="answer" id="answer-{{ $faq->id }}" rows="4" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $faq->answer }}</textarea>
                </div>

                <!-- Urutan -->
                <div class="mb-4">
                    <label for="sort_order-{{ $faq->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order-{{ $faq->id }}" min="0"
                        value="{{ $faq->sort_order }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status-{{ $faq->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status-{{ $faq->id }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="draft" {{ $faq->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $faq->status == 'published' ? 'selected' : '' }}>Published
                        </option>
                        <option value="archived" {{ $faq->status == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $faq->id }}')"
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
            <button onclick="closeUpdateModal('{{ $faq->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
