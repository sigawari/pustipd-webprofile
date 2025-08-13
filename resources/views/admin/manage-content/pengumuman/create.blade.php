<!-- Modal Tambah Pengumuman PUSTIPD -->
<div id="AddModal"
    class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
    <div
        class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-6 relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto md:max-h-none md:overflow-visible">

        <!-- Header dengan style yang konsisten -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Tambah Pengumuman PUSTIPD</h2>
            </div>

            <!-- Tombol X -->
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="addForm" method="POST"
            action="{{ route('admin.manage-content.pengumuman.kelolapengumuman.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Judul Pengumuman -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Maintenance Server SIMAK Terjadwal" onkeyup="autoSlug('#title', '#slug')">
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug URL</label>
                    <input type="text" id="slug" name="slug" readonly
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option value="maintenance">🔧 Maintenance</option>
                        <option value="layanan">💡 Layanan IT</option>
                        <option value="infrastruktur">🌐 Infrastruktur</option>
                        <option value="administrasi">📋 Administrasi</option>
                        <option value="darurat">🚨 Darurat</option>
                    </select>
                </div>

                <!-- Urgency -->
                <div>
                    <label for="urgency" class="block text-sm font-medium text-gray-700 mb-2">
                        Prioritas <span class="text-red-500">*</span>
                    </label>
                    <select id="urgency" name="urgency" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="normal">📢 Normal</option>
                        <option value="penting">⚠️ Penting</option>
                    </select>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date" name="date" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ date('Y-m-d') }}">
                </div>

                <!-- Berlaku Sampai -->
                <div>
                    <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-2">
                        Berlaku Sampai
                    </label>
                    <input type="datetime-local" id="valid_until" name="valid_until"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Opsional - kosongkan jika permanen</p>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="draft">📝 Draft</option>
                        <option value="published">✅ Published</option>
                        <option value="archived">📦 Archived</option>
                    </select>
                </div>
            </div>

            <!-- Content Editor (Full Width seperti style asli) -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Pengumuman <span class="text-red-500">*</span>
                    </label>

                    {{-- Editor Quill --}}
                    <div id="editor" style="height: 200px;"></div>

                    {{-- Hidden textarea untuk form submit --}}
                    <textarea id="content" name="content" class="hidden" required></textarea>
                </div>
            </div>

            <!-- Tombol Action dengan style konsisten -->
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeAddModal()"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
