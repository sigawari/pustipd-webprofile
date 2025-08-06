<!-- Modal Hapus Misi -->
@if ($visiMisi->misi && count($visiMisi->misi) > 0)
    @foreach ($visiMisi->misi as $index => $misiText)
        <div id="deleteMisiModal-{{ $index }}"
            class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <svg class="w-5 h-5 inline mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    Hapus Misi #{{ $index + 1 }}
                </h2>

                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-800">
                        <strong>Peringatan!</strong> Aksi ini tidak dapat dibatalkan. Misi yang dihapus akan hilang
                        secara permanen.
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-3">Misi yang akan dihapus:</p>
                    <blockquote class="border-l-4 border-red-500 pl-4 italic text-gray-700 bg-gray-50 p-3 rounded">
                        "{{ $misiText }}"
                    </blockquote>
                </div>

                <form method="POST" action="{{ route('admin.manage-content.tentang.visi-misi.destroy', $index) }}">
                    @csrf
                    @method('DELETE')

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeDeleteModal({{ $index }})"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus misi ini?')">
                            Ya, Hapus
                        </button>
                    </div>
                </form>

                <button onclick="closeDeleteModal({{ $index }})"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
@endif
