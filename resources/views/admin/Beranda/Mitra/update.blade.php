<!-- Modal Edit Mitra Beranda -->
@foreach ($mitras as $mitra)
    <div id="UpdateModal-{{ $mitra->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4 transition-opacity duration-300">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative transform scale-95 transition-all duration-300">

            <!-- Header -->
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.beranda.mitra.update', $mitra->id) }}" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Mitra -->
                <div>
                    <label for="name-{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nama
                        Mitra</label>
                    <textarea name="name" id="name-{{ $mitra->id }}" rows="2" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tulis nama mitra....">{{ old('name', $mitra->name) }}</textarea>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo Mitra -->
                <div>
                    <label for="image-{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-1">Logo
                        Mitra</label>

                    <!-- Current Image Preview -->
                    @if ($mitra->image)
                        <div class="mb-2">
                            <p class="text-xs text-gray-500 mb-1">Logo saat ini:</p>
                            <img src="{{ asset('storage/' . $mitra->image) }}" alt="{{ $mitra->name }}"
                                class="w-16 h-16 object-contain border border-gray-200 rounded-lg bg-gray-50">
                        </div>
                    @endif

                    <input type="file" name="image" id="image-{{ $mitra->id }}"
                        class="w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah logo</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status-{{ $mitra->id }}"
                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status-{{ $mitra->id }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="draft" {{ old('status', $mitra->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $mitra->status) == 'published' ? 'selected' : '' }}>
                            Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Status -->
                <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p><strong>Draft:</strong> Mitra tidak tampil di halaman publik</p>
                        <p><strong>Published:</strong> Mitra akan tampil di halaman publik</p>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeUpdateModal('{{ $mitra->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Update Mitra
                    </button>
                </div>
            </form>

            <!-- Tombol X -->
            <button onclick="closeUpdateModal('{{ $mitra->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
