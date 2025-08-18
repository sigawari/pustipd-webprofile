<!-- Modal Edit Berita -->
@foreach ($kelolaBeritas as $berita)
    <!-- Modal Tambah Berita Lengkap -->
    <div id="UpdateModal-{{ $berita->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto md:max-h-none md:overflow-visible">

            <!-- Header -->
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-yellow-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.671a.75.75 0 01-.92-.92l.67-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                </svg>
                <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form -->
            <form id="editForm" method="POST"
                action="{{ route('admin.informasi-terkini.kelola-berita.update', $berita->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Nama Berita -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('name', $berita->name) }}">
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
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('slug', $berita->slug) }}">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori
                            Berita</label>
                        <select id="category" name="category" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Kategori</option>
                            <option value="academic_services" @selected($berita->category == 'academic_services')>Layanan Akademik</option>
                            <option value="library_resources" @selected($berita->category == 'library_resources')>Perpustakaan & Sumber Daya
                            </option>
                            <option value="student_information_system" @selected($berita->category == 'student_information_system')>Sistem Informasi
                                Mahasiswa</option>
                            <option value="administration" @selected($berita->category == 'administration')>Administrasi</option>
                            <option value="communication" @selected($berita->category == 'communication')>Komunikasi</option>
                            <option value="research_development" @selected($berita->category == 'research_development')>Penelitian</option>
                            <option value="other" @selected($berita->category == 'other')>Lainnya</option>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ old('tags', $berita->tags) }}">
                    </div>

                    <!-- Jadwal Publish -->
                    <div>
                        <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-2">Jadwal
                            Publish</label>
                        <input type="datetime-local" id="publish_date" name="publish_date"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            value="{{ $berita->publish_date ? date('Y-m-d\TH:i', strtotime($berita->publish_date)) : '' }}">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="draft" @selected($berita->status == 'draft')>Draft</option>
                            <option value="published" @selected($berita->status == 'published')>Published</option>
                            <option value="archived" @selected($berita->status == 'archived')>Archived</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Thumbnail -->
                    <!-- Preview Gambar Lama -->
                    <div class="col-span-1">
                        <label>Gambar Lama</label>
                        @if ($berita->image)
                            <img src="{{ asset('storage/' . $berita->image) }}" alt="Preview"
                                class="w-36 h-36 object-cover rounded-lg mb-2">
                        @else
                            <p class="text-gray-500">Tidak ada gambar</p>
                        @endif

                        <!-- Upload Gambar Baru -->
                        <input type="file" name="image" accept="image/*"
                            class="w-full px-3 py-2 border rounded-lg text-sm">
                        <small class="text-gray-500">Kosongkan jika tidak ingin ganti</small>
                    </div>

                    <!-- Konten Berita -->
                    <div class="col-span-2">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>

                        {{-- Editor Quill --}}
                        <div class="editor" style="height: 200px;">{{ $berita->content }}</div>

                        {{-- Hidden textarea untuk form submit --}}
                        <textarea id="content" name="content" class="hidden">{{ $berita->content }}</textarea>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeUpdateModal('{{ $berita->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X -->
            <button onclick="closeUpdateModal('{{ $berita->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
