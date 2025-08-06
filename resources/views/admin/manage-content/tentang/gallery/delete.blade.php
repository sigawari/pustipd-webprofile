<!-- Modal Hapus Gallery -->
@foreach ($galleries as $gallery)
    <div id="DeleteModal-{{ $gallery->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Hapus {{ $title }}</h2>

            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus Gallery berikut?</p>

            <!-- Preview Item -->
            <div class="border border-gray-200 rounded-lg p-3 mb-6">
                <div class="flex items-center space-x-3">
                    @if ($gallery->image)
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="w-12 h-12 rounded object-cover flex-shrink-0">
                    @else
                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $gallery->title }}</p>
                        @if ($gallery->event_date)
                            <p class="text-sm text-gray-500">{{ $gallery->event_date->format('d M Y') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.manage-content.tentang.gallery.destroy', $gallery->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeDeleteModal('{{ $gallery->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeDeleteModal('{{ $gallery->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

<script>
    // Delete modal functions
    function openDeleteModal(id) {
        document.getElementById('DeleteModal-' + id).classList.remove('hidden');
        document.getElementById('DeleteModal-' + id).classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal(id) {
        document.getElementById('DeleteModal-' + id).classList.add('hidden');
        document.getElementById('DeleteModal-' + id).classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking backdrop
    document.querySelectorAll('[id^="DeleteModal-"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                const id = this.id.replace('DeleteModal-', '');
                closeDeleteModal(id);
            }
        });
    });
</script>
