<!-- Modal Edit App Layanan -->
@foreach ($appLayanans as $appLayanan)
    <div id="UpdateModal-{{ $appLayanan->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300 ease-out">

        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 relative transform transition-all duration-300 ease-out scale-95">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit {{ $title }}
            </h2>

            {{-- Route dan method yang benar --}}
            <form method="POST" action="{{ route('admin.app-layanan.update', $appLayanan->id) }}">
                @csrf
                @method('PUT')

                {{-- Nama Aplikasi --}}
                <div class="mb-4">
                    <label for="appname-{{ $appLayanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Aplikasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="appname" id="appname-{{ $appLayanan->id }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('appname', $appLayanan->appname) }}" placeholder="Masukkan nama aplikasi...">
                    @error('appname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label for="category-{{ $appLayanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category" id="category-{{ $appLayanan->id }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        <option value="akademik"
                            {{ old('category', $appLayanan->category) == 'akademik' ? 'selected' : '' }}>
                            🎓 Akademik
                        </option>
                        <option value="pegawai"
                            {{ old('category', $appLayanan->category) == 'pegawai' ? 'selected' : '' }}>
                            👥 Pegawai
                        </option>
                        <option value="pembelajaran"
                            {{ old('category', $appLayanan->category) == 'pembelajaran' ? 'selected' : '' }}>
                            📖 Pembelajaran
                        </option>
                        <option value="administrasi"
                            {{ old('category', $appLayanan->category) == 'administrasi' ? 'selected' : '' }}>
                            📋 Administrasi
                        </option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="description-{{ $appLayanan->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description-{{ $appLayanan->id }}" rows="4" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Jelaskan fungsi dan kegunaan aplikasi...">{{ old('description', $appLayanan->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Link Aplikasi --}}
                <div class="mb-4">
                    <label for="applink-{{ $appLayanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Link Aplikasi
                    </label>
                    <input type="url" name="applink" id="applink-{{ $appLayanan->id }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('applink', $appLayanan->applink) }}" placeholder="https://example.com">
                    <p class="text-xs text-gray-500 mt-1">Opsional. Link akan digunakan untuk akses langsung ke
                        aplikasi.</p>
                    @error('applink')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status-{{ $appLayanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status-{{ $appLayanan->id }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="draft" {{ old('status', $appLayanan->status) == 'draft' ? 'selected' : '' }}>
                            📝 Draft - Belum dipublikasi
                        </option>
                        <option value="published"
                            {{ old('status', $appLayanan->status) == 'published' ? 'selected' : '' }}>
                            ✅ Published - Tampil di halaman publik
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Info --}}
                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm">
                            <p class="font-medium text-blue-800">Info Update:</p>
                            <p class="text-blue-600">
                                Status <strong>Published</strong> akan menampilkan aplikasi di halaman publik.
                                Status <strong>Draft</strong> hanya terlihat di admin panel.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeUpdateModal('{{ $appLayanan->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Update Aplikasi
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $appLayanan->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
