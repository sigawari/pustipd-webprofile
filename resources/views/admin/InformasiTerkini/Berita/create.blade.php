<!-- Modal Tambah Berita Lengkap -->
<div id="AddModal"
    class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
    <div
        class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto md:max-h-none md:overflow-visible">

        <!-- Header -->
        <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Tambah Berita</h2>
        </div>

        <!-- Form -->
        <form id="addForm" method="POST" action="{{ route('admin.informasi-terkini.kelola-berita.store') }}"
            enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Nama Berita -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Perpustakaan Digital Resmi Diluncurkan">
                </div>

                <!-- Slug -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        if (window.autoSlug) {
                            window.autoSlug("#name", "#slug");
                        }
                    });
                </script>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug" readonly
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori Berita</label>
                    <select id="category" name="category" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option value="academic_services">Layanan Akademik</option>
                        <option value="library_resources">Perpustakaan & Sumber Daya</option>
                        <option value="student_information_system">Sistem Informasi Mahasiswa</option>
                        <option value="administration">Administrasi</option>
                        <option value="communication">Komunikasi</option>
                        <option value="research_development">Penelitian & Pengembangan</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <input type="text" id="tags" name="tags"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Pisahkan dengan koma, contoh: kampus, mahasiswa">
                </div>

                <!-- Jadwal Publish -->
                <div>
                    <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-2">Jadwal
                        Publish</label>
                    <input type="datetime-local" id="publish_date" name="publish_date"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Thumbnail -->
                <div class="col-span-1 flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar</label>

                    <!-- Kotak Preview -->
                    <div id="photo-preview" class="mb-3 hidden">
                        <img id="preview-img" src="" alt="Preview"
                            style="width:150px; height:150px; object-fit:cover; border-radius:0.5rem;">
                    </div>

                    <!-- Icon Upload -->
                    <div id="upload-icon" style="width:150px; height:150px; border-radius: 0.5rem;"
                        class="mb-3 flex items-center justify-center border-2 border-dashed border-gray-300 bg-gray-50 text-gray-400 hover:border-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>

                    <!-- Input File -->
                    <input type="file" name="image" id="image" accept="image/*" required
                        onchange="previewImage(this)"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>

                <!-- Konten Berita -->
                <div class="col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>

                    {{-- Editor Quill --}}
                    <div class="editor" style="height: 200px;"></div>

                    {{-- Hidden textarea untuk form submit --}}
                    <textarea name="content" class="hidden"></textarea>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 pt-2">
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
                    Simpan
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
