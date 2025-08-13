<!-- Modal Hapus Pengumuman -->
@foreach ($kelolaPengumumans as $pengumuman)
    <div id="DeleteModal-{{ $pengumuman->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <!-- Icon Trash -->
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                </svg>
                Hapus {{ $title }}
            </h2>

            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus {{ $title }} berikut?</p>

            <blockquote class="border-l-4 border-blue-500 pl-4 italic mb-6 text-gray-700 bg-gray-50 p-3 rounded">
                {{ $pengumuman->title }}
                <br>
                "{{ $pengumuman->slug }}"
            </blockquote>

            <form method="POST"
                action="{{ route('admin.manage-content.pengumuman.kelolapengumuman.destroy', $pengumuman->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeDeleteModal('{{ $pengumuman->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <!-- Icon X -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 flex items-center gap-1">
                        <!-- Icon Trash -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeDeleteModal('{{ $pengumuman->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
