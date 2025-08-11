<!-- Modal Edit Berita -->
@foreach ($kelolaBeritas as $berita)

<div id="UpdateModal-{{ $berita->id }}"
    class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4 transition-opacity duration-300">
    <div
        class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative transform scale-95 transition-all duration-300">

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
            action="{{ route('admin.manage-content.berita.kelolaberita.update', $berita->id) }}"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Kategori -->
                <div>
                    <label for="editCategory" class="block text-sm font-medium text-gray-700 mb-2">Kategori Berita</label>
                    <select id="editCategory" name="category" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option value="academic_services" {{ $berita->category == 'academic_services' ? 'selected' : '' }}>Layanan Akademik</option>
                        <option value="library_resources" {{ $berita->category == 'library_resources' ? 'selected' : '' }}>Perpustakaan & Sumber Daya</option>
                        <option value="student_information_system" {{ $berita->category == 'student_information_system' ? 'selected' : '' }}>Sistem Informasi Mahasiswa</option>
                        <option value="administration" {{ $berita->category == 'administration' ? 'selected' : '' }}>Administrasi</option>
                        <option value="communication" {{ $berita->category == 'communication' ? 'selected' : '' }}>Komunikasi</option>
                        <option value="research_development" {{ $berita->category == 'research_development' ? 'selected' : '' }}>Penelitian & Pengembangan</option>
                        <option value="other" {{ $berita->category == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Nama Berita -->
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700 mb-2">Nama Berita</label>
                    <input type="text" id="editName" name="name" value="{{ $berita->name }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Link Akses -->
                <div>
                    <label for="editLink" class="block text-sm font-medium text-gray-700 mb-2">Link Akses Berita</label>
                    <input type="url" id="editLink" name="link" value="{{ $berita->link }}" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Status -->
                <div>
                    <label for="editStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="editStatus" name="status" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="draft" {{ $berita->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $berita->status == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ $berita->status == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Deskripsi Singkat -->
                <div class="sm:col-span-2">
                    <label for="editDescription" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea id="editDescription" name="description" rows="3" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $berita->description }}</textarea>
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
        <button onclick="closeUpdateModal('{{ $berita->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

@endforeach