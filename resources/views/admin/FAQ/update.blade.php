<!-- Modal Edit FAQ -->
@foreach ($faqs as $faq)
    <div id="UpdateModal-{{ $faq->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300 ease-out">

        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative transform transition-all duration-300 ease-out scale-95">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Edit {{ $title }}
            </h2>

            <form method="POST" action="{{ route('admin.faq.update', $faq->id) }}">
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
                        <!-- Icon Update -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $faq->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
