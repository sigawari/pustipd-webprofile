<!-- Modal Tambah AppLayanan -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.app-layanan.store') }}" class="space-y-4">
            @csrf

            {{-- HIDDEN: Status otomatis draft --}}
            <input type="hidden" name="status" value="draft">

            <!-- Nama Aplikasi -->
            <div>
                <label for="appname" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Aplikasi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="appname" id="appname" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama aplikasi..." value="{{ old('appname') }}">
                @error('appname')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category" id="category" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>🎓 Akademik</option>
                    <option value="pegawai" {{ old('category') == 'pegawai' ? 'selected' : '' }}>👥 Pegawai</option>
                    <option value="pembelajaran" {{ old('category') == 'pembelajaran' ? 'selected' : '' }}>📖
                        Pembelajaran</option>
                    <option value="administrasi" {{ old('category') == 'administrasi' ? 'selected' : '' }}>📋
                        Administrasi</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Jelaskan fungsi dan kegunaan aplikasi...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Link Aplikasi -->
            <div>
                <label for="applink" class="block text-sm font-medium text-gray-700 mb-1">Link Aplikasi</label>
                <input type="url" name="applink" id="applink"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="https://example.com" value="{{ old('applink') }}">
                <p class="text-xs text-gray-500 mt-1">Opsional. Link akan digunakan untuk akses langsung ke aplikasi.
                </p>
                @error('applink')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- INFO: Status workflow --}}
            <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Info</p>
                        <p class="text-xs text-blue-600">
                            Aplikasi akan disimpan sebagai <strong>Draft</strong> dan tidak akan tampil di halaman
                            publik.
                            Admin dapat mengubah status ke <strong>Published</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan sebagai Draft
                </button>
            </div>
        </form>

        <!-- Tombol X -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
