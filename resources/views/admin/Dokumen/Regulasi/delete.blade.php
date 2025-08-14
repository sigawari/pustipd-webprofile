@foreach ($regulasis as $regulasi)
    <!-- Modal Hapus Regulasi -->
    <div id="DeleteModal-{{ $regulasi->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Hapus {{ $title }}</h2>

            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus Regulasi berikut?</p>

            <div id="deleteRegulasiInfo" class="border-l-4 border-blue-500 pl-4 mb-6 bg-gray-50 p-3 rounded">
                <h4 class="font-semibold text-gray-700">{{ $regulasi->title }}</h4>
                <p class="text-sm text-gray-600 mt-1">{{ Str::limit(strip_tags($regulasi->description), 10) }}</p>
                <div class="text-xs text-gray-500 mt-2">
                    <span>{{ $regulasi->year_published ?? '-' }}</span>
                    <span class="ml-2">{{ $regulasi->original_filename }}</span>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    <p class="text-sm text-yellow-800">{{ $title }} akan dihapus dan tidak bisa di-restore kembali.</p>
                </div>
            </div>

            <form id="deleteForm-{{ $regulasi->id }}" method="POST" action="{{ route('admin.dokumen.regulasi.destroy', $regulasi->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeDeleteModal('{{ $regulasi->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-orange-600 rounded-lg hover:bg-orange-700">
                        Hapus
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeDeleteModal('{{ $regulasi->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach