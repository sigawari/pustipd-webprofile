<!-- resources/views/admin/manage-content/struktur-organisasi/create.blade.php -->
<x-admin.layouts title="{{ $title }}">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                <p class="text-gray-600">Tambah anggota baru ke struktur organisasi</p>
            </div>

            <form method="POST" action="{{ route('admin.manage-content.struktur-organisasi.store') }}"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divisi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Divisi <span class="text-red-500">*</span>
                    </label>
                    <select name="divisi" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Divisi</option>
                        @foreach ($divisiList as $key => $value)
                            <option value="{{ $key }}" {{ old('divisi') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('divisi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan Index -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan dalam Divisi <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="urutan_index" value="{{ old('urutan_index', 1) }}" min="1"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Angka kecil akan ditampilkan lebih awal</p>
                    @error('urutan_index')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                    @error('foto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                            Active - Tampil di halaman public
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive - Tidak tampil di halaman public
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('admin.manage-content.tentang.struktur-organisasi.index') }}"
                        class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layouts>
