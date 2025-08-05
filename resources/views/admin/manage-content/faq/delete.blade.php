<!-- Modal Hapus FAQ -->
@foreach ($faqs as $faq)
    <div id="DeleteModal-{{ $faq->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Hapus {{ $title }}</h2>

            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus FAQ berikut?</p>

            <blockquote class="border-l-4 border-blue-500 pl-4 italic mb-6 text-gray-700 bg-gray-50 p-3 rounded">
                "{{ $faq->question }}"
            </blockquote>

            <form method="POST" action="{{ route('admin.manage-content.faq.destroy', $faq->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeDeleteModal('{{ $faq->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeDeleteModal('{{ $faq->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
