<!-- resources/views/admin/manage-content/beranda/mitra.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Berita PUSTIPD')
    @section('page-description', content: 'Kelola konten berita')
    @section('breadcrumb')
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Kelola Konten</span>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Berita</span>
            </div>
        </li>
    @endsection

    <!-- Content Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Berita</h2>
                <p class="text-gray-600 mt-1 text-sm">Kelola berita berdasarkan kategori yang akan ditampilkan di
                    halaman berita</p>
            </div>
            <button onclick="openAddModal()"
                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Berita
            </button>
        </div>

        <script>
            window.bulkActionRoute = "{{ route('admin.manage-content.berita.kelolaberita.bulk') }}";
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                window.initBulkActions();
            });
        </script>

        <!-- Actions berdasarkan status yang dipilih -->
        <div class="flex flex-col sm:flex-row gap-2" id="bulkActionButtons">
            <!-- Default actions (untuk draft/published) -->
            <div id="defaultActions">
                <button onclick="bulkAction('published')"
                    class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"></path>
                    </svg>
                    Publish
                </button>
                <button onclick="bulkAction('draft')"
                    class="px-3 py-2 text-sm bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                    </svg>
                    Draft
                </button>
                <button onclick="bulkAction('archived')"
                    class="px-3 py-2 text-sm bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8l6 6m0 0l6-6m-6 6V3"></path>
                    </svg>
                    Archive
                </button>
            </div>

            <!-- Actions untuk archived items -->
            <div id="archivedActions" class="hidden">
                <button onclick="bulkAction('draft')"
                    class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Restore
                </button>
                <button onclick="bulkAction('permanent_delete')"
                    class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Hapus Permanen
                </button>
            </div>
        </div>

        <!-- Filter dan Search - MOBILE RESPONSIVE -->
        <div class="flex flex-col gap-3 mb-4 sm:mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="searchInput" placeholder="Cari Berita..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <select id="categoryFilter"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="">Semua Kategori</option>
                    <option value="academic_services">Layanan Akademik</option>
                    <option value="library_resources">Perpustakaan & Sumber Daya</option>
                    <option value="student_information_system">Sistem Informasi Mahasiswa</option>
                    <option value="administration">Administrasi</option>
                    <option value="communication">Komunikasi</option>
                    <option value="research_development">Penelitian & Pengembangan</option>
                    <option value="other">Lainnya</option>
                </select>
                <select id="statusFilter"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
                <select id="perPage"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                </select>
            </div>
        </div>

        <!-- Table dengan scroll horizontal untuk mobile -->
        <div class="overflow-x-auto -mx-3 sm:mx-0">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" style="min-width: 900px;">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Berita</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Link Akses</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="beritaTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.manage-content.berita.partials.table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4">
            <!-- Info jumlah data -->
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan {{ $kelolaBeritas->firstItem() }} sampai {{ $kelolaBeritas->lastItem() }} dari {{ $kelolaBeritas->total() }}
                {{ strtolower($title) }}
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    <!-- Tombol Sebelumnya -->
                    @if ($kelolaBeritas->onFirstPage())
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <!-- Icon: panah kiri -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <!-- Teks hanya di desktop -->
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $kelolaBeritas->previousPageUrl() }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    {{-- Tombol Angka Halaman --}}
                    @foreach ($kelolaBeritas->getUrlRange(1, $kelolaBeritas->lastPage()) as $page => $url)
                        @if ($page == $kelolaBeritas->currentPage())
                            {{-- Halaman aktif --}}
                            <span
                                class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            {{-- Halaman lain (indikator saja, tidak bisa diklik) --}}
                            <span
                                class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                {{ $page }}
                            </span>
                        @endif
                    @endforeach

                    <!-- Tombol Selanjutnya -->
                    @if ($kelolaBeritas->hasMorePages())
                        <a href="{{ $kelolaBeritas->nextPageUrl() }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <span class="hidden sm:inline">Selanjutnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <span class="hidden sm:inline">Selanjutnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </div>

        @include('admin.manage-content.berita.create')
        @include('admin.manage-content.berita.update')
        @include('admin.manage-content.berita.delete')


        <!-- Bulk Actions -->
        <!-- <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 pt-4 border-t border-gray-200 gap-3">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 pl-2 sm:pl-0">
                <div class="flex flex-col sm:flex-row gap-2 w-fit">
                    <select id="bulkAction"
                        class="w-48 sm:w-auto px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Aksi untuk yang dipilih</option>
                        <option value="publish">Publikasikan</option>
                        <option value="draft">Jadikan Draft</option>
                        <option value="archive">Arsipkan</option>
                        <option value="delete">Hapus</option>
                    </select>
                    <button onclick="applyBulkAction()"
                        class="w-24 sm:w-auto px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 transition-colors duration-200"
                        id="bulkActionBtn" disabled>
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="hidden sm:inline">Terapkan</span>
                            <span class="sm:hidden">Apply</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="text-sm text-gray-500 self-start sm:self-auto pl-2 sm:pl-0 sm:text-right">
                <div class="flex items-center justify-start sm:justify-end">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span id="selectedCount">0 aplikasi dipilih</span>
                </div>
            </div>
        </div> -->
    </div>

    <!-- Modal Add/Edit Aplikasi -->
    <div id="appModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeAppModal()"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="appForm">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="appModalTitle">
                                    Tambah Aplikasi Baru
                                </h3>

                                <!-- Kategori -->
                                <div class="mb-4">
                                    <label for="appCategory"
                                        class="block text-sm font-medium text-gray-700 mb-2">Kategori Aplikasi</label>
                                    <select id="appCategory" name="category" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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

                                <!-- Nama Aplikasi -->
                                <div class="mb-4">
                                    <label for="appName" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Berita</label>
                                    <input type="text" id="appName" name="name" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Contoh: SIAKAD, Perpustakaan Digital, dll">
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-4">
                                    <label for="appDescription"
                                        class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                                    <textarea id="appDescription" name="description" rows="3" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Deskripsi singkat tentang fungsi Berita ini..."></textarea>
                                </div>

                                <!-- Hyperlink -->
                                <div class="mb-4">
                                    <label for="appLink" class="block text-sm font-medium text-gray-700 mb-2">Link
                                        Akses Berita</label>
                                    <input type="url" id="appLink" name="link" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="https://example.com">
                                    <p class="text-xs text-gray-500 mt-1">URL lengkap untuk mengakses Berita</p>
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select id="appStatus" name="status" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" onclick="closeAppModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="appPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeAppPreviewModal()">
            </div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Preview Berita</h3>

                        <div
                            class="bg-gradient-to-br from-white to-gray-50 rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div
                                class="w-16 h-16 mx-auto mb-4 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span id="previewCategory"
                                class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mb-2">Kategori</span>
                            <h4 id="previewName" class="text-lg font-semibold text-gray-900 mb-2">Nama Berita</h4>
                            <p id="previewDescription" class="text-sm text-gray-600 mb-3">Deskripsi Berita</p>
                            <a id="previewLink" href="#" target="_blank"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                Akses Berita
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeAppPreviewModal()"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        (function() {
            'use strict';

            const AppManager = {
                data: [{
                        id: 1,
                        category: "Academic Services",
                        name: "SIAKAD",
                        description: "Sistem Akademik Terintegrasi untuk mahasiswa dan dosen",
                        link: "https://siakad.uinrf.ac.id",
                        status: "published",
                        created_at: "2025-01-15",
                        updated_at: "2025-01-20"
                    },
                    {
                        id: 2,
                        category: "Library & Resources",
                        name: "Perpustakaan Digital",
                        description: "Akses koleksi buku dan jurnal digital",
                        link: "https://library.uinrf.ac.id",
                        status: "published",
                        created_at: "2025-02-10",
                        updated_at: "2025-02-15"
                    },
                    {
                        id: 3,
                        category: "Communication",
                        name: "Email Campus",
                        description: "Layanan email resmi untuk civitas akademik",
                        link: "https://mail.uinrf.ac.id",
                        status: "draft",
                        created_at: "2025-03-01",
                        updated_at: "2025-03-05"
                    },
                    {
                        id: 4,
                        category: "Student Information System",
                        name: "Portal Mahasiswa",
                        description: "Informasi akademik dan layanan mahasiswa",
                        link: "https://portal.uinrf.ac.id",
                        status: "published",
                        created_at: "2025-01-25",
                        updated_at: "2025-02-28"
                    },
                    {
                        id: 5,
                        category: "Research & Development",
                        name: "Research Database",
                        description: "Database penelitian dan publikasi ilmiah",
                        link: "https://research.uinrf.ac.id",
                        status: "archived",
                        created_at: "2024-12-10",
                        updated_at: "2025-01-10"
                    }
                ],
                filteredData: [],
                currentPage: 1,
                perPage: 10,
                selectedIds: new Set(),

                init() {
                    this.filteredData = [...this.data];
                    this.bindEvents();
                    this.render();
                },

                bindEvents() {
                    // Search functionality
                    const searchInput = document.getElementById('searchInput');
                    if (searchInput) {
                        searchInput.addEventListener('input', () => this.applyFilters());
                    }

                    // Category filter
                    const categoryFilter = document.getElementById('categoryFilter');
                    if (categoryFilter) {
                        categoryFilter.addEventListener('change', () => this.applyFilters());
                    }

                    // Status filter
                    const statusFilter = document.getElementById('statusFilter');
                    if (statusFilter) {
                        statusFilter.addEventListener('change', () => this.applyFilters());
                    }

                    // Per page selector
                    const perPageSelect = document.getElementById('perPage');
                    if (perPageSelect) {
                        perPageSelect.addEventListener('change', (e) => {
                            this.perPage = parseInt(e.target.value);
                            this.currentPage = 1;
                            this.render();
                        });
                    }

                    // Select all checkbox
                    const selectAllCheckbox = document.getElementById('selectAll');
                    if (selectAllCheckbox) {
                        selectAllCheckbox.addEventListener('change', () => {
                            this.toggleSelectAll(selectAllCheckbox.checked);
                        });
                    }

                    // Form submission
                    const form = document.getElementById('appForm');
                    if (form) {
                        form.addEventListener('submit', (e) => {
                            this.handleFormSubmit(e);
                        });
                    }

                    // Keyboard shortcuts
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            this.closeAllModals();
                        }
                    });
                },

                applyFilters() {
                    const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';
                    const categoryFilter = document.getElementById('categoryFilter')?.value || '';
                    const statusFilter = document.getElementById('statusFilter')?.value || '';

                    this.filteredData = this.data.filter(item => {
                        const matchesSearch = item.name.toLowerCase().includes(searchTerm) ||
                            item.description.toLowerCase().includes(searchTerm);
                        const matchesCategory = categoryFilter ? item.category === categoryFilter : true;
                        const matchesStatus = statusFilter ? item.status === statusFilter : true;

                        return matchesSearch && matchesCategory && matchesStatus;
                    });

                    this.currentPage = 1;
                    this.selectedIds.clear();
                    this.updateSelectAllState();
                    this.render();
                },

                render() {
                    this.renderTable();
                    this.renderPagination();
                    this.updateSelectedCount();
                },

                renderTable() {
                    const tableBody = document.getElementById('appTableBody');
                    if (!tableBody) return;

                    tableBody.innerHTML = '';

                    const start = (this.currentPage - 1) * this.perPage;
                    const pageItems = this.filteredData.slice(start, start + this.perPage);

                    if (pageItems.length === 0) {
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Tidak ada aplikasi ditemukan
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    pageItems.forEach(item => {
                        const row = this.createTableRow(item);
                        tableBody.appendChild(row);
                    });
                },

                createTableRow(item) {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';

                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                   data-id="${item.id}" ${this.selectedIds.has(item.id) ? 'checked' : ''}>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ${item.category}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${item.name}</div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-sm text-gray-600 truncate">${item.description}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="${item.link}" target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Akses
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${this.createStatusBadge(item.status)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>Dibuat: ${item.created_at}</div>
                            <div>Update: ${item.updated_at}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button onclick="previewApp(${item.id})" class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Preview">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="editApp(${item.id})" class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteApp(${item.id})" class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    `;

                    // Bind checkbox event
                    const checkbox = tr.querySelector('.row-checkbox');
                    checkbox.addEventListener('change', () => {
                        if (checkbox.checked) {
                            this.selectedIds.add(item.id);
                        } else {
                            this.selectedIds.delete(item.id);
                        }
                        this.updateSelectedCount();
                        this.updateSelectAllState();
                    });

                    return tr;
                },

                createStatusBadge(status) {
                    const badges = {
                        'published': 'bg-green-100 text-green-800',
                        'draft': 'bg-yellow-100 text-yellow-800',
                        'archived': 'bg-gray-100 text-gray-800'
                    };

                    const colors = badges[status] || badges['draft'];

                    return `
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${colors}">
                            <div class="w-1.5 h-1.5 bg-current rounded-full mr-1.5 opacity-75"></div>
                            ${status.charAt(0).toUpperCase() + status.slice(1)}
                        </span>
                    `;
                },

                renderPagination() {
                    const totalPages = Math.ceil(this.filteredData.length / this.perPage);
                    const start = (this.currentPage - 1) * this.perPage + 1;
                    const end = Math.min(this.currentPage * this.perPage, this.filteredData.length);

                    // Update pagination info
                    const paginationInfo = document.getElementById('paginationInfo');
                    if (paginationInfo) {
                        paginationInfo.textContent =
                            `Menampilkan ${start} sampai ${end} dari ${this.filteredData.length} aplikasi`;
                    }

                    // Desktop pagination
                    this.renderPaginationControls('paginationControls', totalPages, false);

                    // Mobile pagination
                    this.renderPaginationControls('paginationControlsMobile', totalPages, true);
                },

                renderPaginationControls(containerId, totalPages, isMobile) {
                    const container = document.getElementById(containerId);
                    if (!container || totalPages <= 1) {
                        if (container) container.innerHTML = '';
                        return;
                    }

                    container.innerHTML = '';

                    // Previous button
                    const prevBtn = this.createPaginationButton(
                        isMobile ? '‹' : 'Sebelumnya',
                        this.currentPage - 1,
                        this.currentPage === 1,
                        false,
                        isMobile
                    );
                    container.appendChild(prevBtn);

                    // Page numbers
                    const startPage = Math.max(1, this.currentPage - (isMobile ? 1 : 2));
                    const endPage = Math.min(totalPages, this.currentPage + (isMobile ? 1 : 2));

                    for (let i = startPage; i <= endPage; i++) {
                        const pageBtn = this.createPaginationButton(
                            i.toString(),
                            i,
                            false,
                            i === this.currentPage,
                            isMobile
                        );
                        container.appendChild(pageBtn);
                    }

                    // Next button
                    const nextBtn = this.createPaginationButton(
                        isMobile ? '›' : 'Selanjutnya',
                        this.currentPage + 1,
                        this.currentPage === totalPages,
                        false,
                        isMobile
                    );
                    container.appendChild(nextBtn);
                },

                createPaginationButton(text, page, disabled = false, active = false, mobile = false) {
                    const button = document.createElement('button');
                    button.textContent = text;

                    if (mobile) {
                        button.className =
                            'px-2 py-1 text-xs font-medium rounded border border-gray-300 hover:bg-gray-50';
                    } else {
                        button.className =
                            'px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50';
                    }

                    if (active) {
                        button.classList.remove('border-gray-300', 'hover:bg-gray-50');
                        button.classList.add('bg-blue-600', 'text-white', 'border-transparent');
                    }

                    if (disabled) {
                        button.classList.add('opacity-50', 'cursor-not-allowed');
                        button.disabled = true;
                    } else {
                        button.addEventListener('click', () => {
                            this.currentPage = page;
                            this.render();
                        });
                    }

                    return button;
                },

                toggleSelectAll(checked) {
                    this.selectedIds.clear();
                    if (checked) {
                        const start = (this.currentPage - 1) * this.perPage;
                        const pageItems = this.filteredData.slice(start, start + this.perPage);
                        pageItems.forEach(item => this.selectedIds.add(item.id));
                    }

                    document.querySelectorAll('.row-checkbox').forEach(cb => {
                        cb.checked = checked;
                    });

                    this.updateSelectedCount();
                },

                updateSelectAllState() {
                    const selectAllCheckbox = document.getElementById('selectAll');
                    if (!selectAllCheckbox) return;

                    const visibleCheckboxes = document.querySelectorAll('.row-checkbox');
                    const checkedCount = Array.from(visibleCheckboxes).filter(cb => cb.checked).length;

                    if (checkedCount === 0) {
                        selectAllCheckbox.indeterminate = false;
                        selectAllCheckbox.checked = false;
                    } else if (checkedCount === visibleCheckboxes.length) {
                        selectAllCheckbox.indeterminate = false;
                        selectAllCheckbox.checked = true;
                    } else {
                        selectAllCheckbox.indeterminate = true;
                    }
                },

                updateSelectedCount() {
                    const count = this.selectedIds.size;
                    const countElement = document.getElementById('selectedCount');
                    const bulkBtn = document.getElementById('bulkActionBtn');

                    if (countElement) {
                        countElement.textContent = `${count} aplikasi dipilih`;
                    }

                    if (bulkBtn) {
                        bulkBtn.disabled = count === 0;
                    }
                },

                handleFormSubmit(event) {
                    event.preventDefault();

                    const formData = new FormData(event.target);
                    const appData = {
                        category: formData.get('category'),
                        name: formData.get('name'),
                        description: formData.get('description'),
                        link: formData.get('link'),
                        status: formData.get('status')
                    };

                    // Validation
                    if (!appData.category || !appData.name || !appData.description || !appData.link) {
                        alert('Semua field harus diisi!');
                        return;
                    }

                    // URL validation
                    try {
                        new URL(appData.link);
                    } catch {
                        alert('Format URL tidak valid!');
                        return;
                    }

                    console.log('App data:', appData);
                    this.closeAppModal();
                    alert('Aplikasi berhasil disimpan! (Demo)');
                },

                closeAllModals() {
                    this.closeAppModal();
                    this.closeAppPreviewModal();
                },

                closeAppModal() {
                    const modal = document.getElementById('appModal');
                    if (modal) {
                        modal.classList.add('hidden');
                        document.getElementById('appForm').reset();
                    }
                },

                closeAppPreviewModal() {
                    const modal = document.getElementById('appPreviewModal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                },

                openAppModal(appData = null) {
                    const modal = document.getElementById('appModal');
                    const title = document.getElementById('appModalTitle');

                    if (modal) {
                        modal.classList.remove('hidden');

                        if (appData) {
                            title.textContent = 'Edit Aplikasi';
                            // Populate form with existing data
                            document.getElementById('appCategory').value = appData.category;
                            document.getElementById('appName').value = appData.name;
                            document.getElementById('appDescription').value = appData.description;
                            document.getElementById('appLink').value = appData.link;
                            document.getElementById('appStatus').value = appData.status;
                        } else {
                            title.textContent = 'Tambah Aplikasi Baru';
                            document.getElementById('appForm').reset();
                        }
                    }
                },

                previewApp(id) {
                    const app = this.data.find(item => item.id === id);
                    if (app) {
                        document.getElementById('previewCategory').textContent = app.category;
                        document.getElementById('previewName').textContent = app.name;
                        document.getElementById('previewDescription').textContent = app.description;
                        document.getElementById('previewLink').href = app.link;

                        const modal = document.getElementById('appPreviewModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                        }
                    }
                },

                editApp(id) {
                    const app = this.data.find(item => item.id === id);
                    if (app) {
                        this.openAppModal(app);
                    }
                },

                deleteApp(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')) {
                        console.log('Delete app:', id);
                        alert('Aplikasi berhasil dihapus! (Demo)');
                    }
                }
            };

            // Global functions
            window.openAppModal = () => AppManager.openAppModal();
            window.closeAppModal = () => AppManager.closeAppModal();
            window.closeAppPreviewModal = () => AppManager.closeAppPreviewModal();
            window.previewApp = (id) => AppManager.previewApp(id);
            window.editApp = (id) => AppManager.editApp(id);
            window.deleteApp = (id) => AppManager.deleteApp(id);

            window.applyBulkAction = function() {
                const selectedIds = Array.from(AppManager.selectedIds);
                const action = document.getElementById('bulkAction')?.value;

                if (selectedIds.length === 0) {
                    alert('Pilih minimal 1 aplikasi untuk melakukan aksi bulk');
                    return;
                }

                if (!action) {
                    alert('Pilih aksi yang akan diterapkan');
                    return;
                }

                const actionTexts = {
                    'publish': 'publikasikan',
                    'draft': 'jadikan draft',
                    'archive': 'arsipkan',
                    'delete': 'hapus'
                };

                const actionText = actionTexts[action] || action;

                if (confirm(`Apakah Anda yakin ingin ${actionText} ${selectedIds.length} aplikasi yang dipilih?`)) {
                    console.log('Bulk action:', action, 'IDs:', selectedIds);
                    alert(`${selectedIds.length} aplikasi berhasil ${actionText}! (Demo)`);

                    // Reset selections
                    AppManager.selectedIds.clear();
                    document.getElementById('selectAll').checked = false;
                    document.getElementById('bulkAction').value = '';
                    AppManager.updateSelectedCount();
                    AppManager.render();
                }
            };

            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', () => {
                AppManager.init();
            });

        })();
    </script> -->

</x-admin.layouts>
