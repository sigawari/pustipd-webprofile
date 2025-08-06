<!-- Modal Edit Misi -->
@if (isset($visiMisi) && $visiMisi->misi && count($visiMisi->misi) > 0)
    @foreach ($visiMisi->misi as $index => $misiText)
        <div id="updateMisiModal-{{ $index }}"
            class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4" data-modal-type="update"
            data-modal-index="{{ $index }}">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative" onclick="event.stopPropagation()">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit Misi #{{ $index + 1 }}</h2>

                <form method="POST" action="{{ route('admin.manage-content.tentang.visi-misi.update-misi', $index) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="description-{{ $index }}"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Misi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description-{{ $index }}" rows="6" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">{{ old('description', $misiText) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Minimal 10 karakter, maksimal 1000 karakter
                        </p>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="CloseUpdateModal('{{ $index }}')"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-secondary rounded-lg hover:bg-secondary/80">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <!-- Tombol X di pojok -->
                <button onclick="CloseUpdateModal('{{ $index }}')"
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
