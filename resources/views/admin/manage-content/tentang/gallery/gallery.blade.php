<!-- resources/views/admin/manage-content/about/profile.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- @section('page-title', 'Galeri PUSTIPD')
    @section('page-description', 'Kelola konten galeri PUSTIPD')
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
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Gambar {{$title}} PUSTIPD</span>
            </div>
        </li>
    @endsection -->

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{$title}}</h2>
                <p class="text-gray-600 mt-1">Kelola foto dan deskripsi kegiatan untuk {{$title}} PUSTIPD</p>
            </div>
            <button onclick="openGalleryModal()"
                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Foto
            </button>
        </div>

        <!-- Filter dan Search - Mobile Responsive -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" placeholder="Cari foto atau kegiatan..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <select id="statusFilter"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
                <select id="perPage"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
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
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Preview</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
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
                        <tbody id="galleryTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination - DIPERBAIKI UNTUK MOBILE -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4 pt-4">
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari
                <span class="font-medium">15</span> {{$title}} foto
            </div>

            <!-- Mobile Pagination -->
            <div class="flex justify-center sm:hidden">
                <div class="flex items-center space-x-1">
                    <button
                        class="px-2 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        ‹
                    </button>
                    <button
                        class="px-2 py-1 text-xs font-medium text-white bg-blue-600 border border-transparent rounded">1</button>
                    <button
                        class="px-2 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50">2</button>
                    <button
                        class="px-2 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50">3</button>
                    <button
                        class="px-2 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50">
                        ›
                    </button>
                </div>
            </div>

            <!-- Desktop Pagination -->
            <div class="hidden sm:flex items-center space-x-2">
                <button
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Sebelumnya
                </button>
                <button
                    class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700">1</button>
                <button
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">2</button>
                <button
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">3</button>
                <button
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                    Selanjutnya
                </button>
            </div>
        </div>

        <!-- Bulk Actions - COMPACT LEFT-ALIGNED UNTUK MOBILE -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 mt-4 pt-4 border-t border-gray-200">
            <!-- Actions Section - MOBILE COMPACT -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:space-x-2 pl-2">
                <!-- Mobile Layout: Compact & Left-aligned -->
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-2 w-fit sm:w-auto">
                    <select id="bulkAction"
                        class="w-48 sm:w-auto px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option value="">Aksi untuk yang dipilih</option>
                        <option value="publish">Publikasikan</option>
                        <option value="draft">Jadikan Draft</option>
                        <option value="schedule">Jadwalkan</option>
                        <option value="archive">Arsipkan</option>
                        <option value="delete">Hapus</option>
                    </select>
                    <button onclick="applyBulkAction()"
                        class="w-24 sm:w-auto px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                        id="bulkActionBtn" disabled>
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="hidden sm:inline">Terapkan</span>
                            <span class="sm:hidden">Apply</span>
                        </span>
                    </button>
                </div>
            </div>

            <!-- Counter Section - MOBILE COMPACT -->
            <div class="text-sm text-gray-500 self-start sm:self-auto pl-2 sm:pl-0 sm:text-right">
                <div class="flex items-center justify-start sm:justify-end">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span id="selected-count">0</span> item dipilih
                </div>
            </div>
        </div>

        <!-- Modal Add/Edit Gallery -->
        <div id="galleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeGalleryModal()">
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form id="galleryForm" enctype="multipart/form-data">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4"
                                        id="galleryModalTitle">
                                        Tambah Foto {{$title}}
                                    </h3>

                                    <!-- Photo Upload -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload
                                            Foto</label>
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200">
                                            <input type="file" id="photoInput" name="photo" accept="image/*"
                                                class="hidden" required>
                                            <div id="photoPreview" class="hidden mb-4">
                                                <img id="previewImage"
                                                    class="mx-auto h-32 w-auto rounded-lg object-cover" src=""
                                                    alt="Preview">
                                            </div>
                                            <div id="uploadPlaceholder">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="mt-4">
                                                    <button type="button"
                                                        onclick="document.getElementById('photoInput').click()"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                        Pilih Foto
                                                    </button>
                                                    <p class="mt-2 text-sm text-gray-500">PNG, JPG, GIF hingga
                                                        10MB
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Deskripsi Kegiatan -->
                                    <div class="mb-4">
                                        <label for="description"
                                            class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                                            Kegiatan</label>
                                        <textarea id="description" name="description" rows="4" required
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Deskripsi lengkap kegiatan atau acara yang terdapat dalam foto ini..."></textarea>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select id="status" name="status" required
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
                            <button type="button" onclick="closeGalleryModal()"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div id="galleryPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75"
                    onclick="closeGalleryPreviewModal()"></div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                        <div class="text-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Preview Foto {{$title}}
                            </h3>

                            <div class="bg-gray-50 rounded-xl p-6">
                                <img id="previewModalImage" class="mx-auto max-h-80 rounded-lg object-contain"
                                    src="" alt="Preview">
                                <h4 id="previewModalDescription"
                                    class="text-base font-medium text-gray-900 mt-4 text-center">Deskripsi foto
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button onclick="closeGalleryPreviewModal()"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';

            const GalleryManager = {
                data: [{
                        id: 1,
                        src: "https://via.placeholder.com/150x100?text=Foto+1",
                        description: "Kegiatan Seminar Nasional PUSTIPD 2024",
                        status: "published",
                        created_at: "2025-07-01",
                        updated_at: "2025-07-15"
                    },
                    {
                        id: 2,
                        src: "https://via.placeholder.com/150x100?text=Foto+2",
                        description: "Workshop Pengembangan Aplikasi Mobile",
                        status: "draft",
                        created_at: "2025-06-15",
                        updated_at: "2025-06-20"
                    },
                    {
                        id: 3,
                        src: "https://via.placeholder.com/150x100?text=Foto+3",
                        description: "Pelatihan Bahasa Inggris untuk Mahasiswa",
                        status: "published",
                        created_at: "2024-12-10",
                        updated_at: "2025-01-05"
                    },
                    {
                        id: 4,
                        src: "https://via.placeholder.com/150x100?text=Foto+4",
                        description: "Kegiatan Pengabdian Masyarakat di Palembang",
                        status: "archived",
                        created_at: "2024-11-05",
                        updated_at: "2024-11-10"
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
                    const searchInput = document.querySelector("input[type='search']");
                    if (searchInput) {
                        searchInput.addEventListener('input', (e) => {
                            this.applyFilters(e.target.value);
                        });
                    }

                    // Status filter
                    const statusFilter = document.getElementById('statusFilter');
                    if (statusFilter) {
                        statusFilter.addEventListener('change', () => {
                            this.applyFilters();
                        });
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

                    // Bulk actions
                    const bulkActionSelect = document.getElementById('galleryBulkAction');
                    const bulkApplyBtn = document.getElementById('galleryBulkApply');

                    if (bulkActionSelect) {
                        bulkActionSelect.addEventListener('change', () => {
                            if (bulkApplyBtn) {
                                bulkApplyBtn.disabled = !bulkActionSelect.value || this.selectedIds.size ===
                                    0;
                            }
                        });
                    }

                    if (bulkApplyBtn) {
                        bulkApplyBtn.addEventListener('click', () => {
                            this.applyBulkAction();
                        });
                    }

                    // Photo input preview
                    const photoInput = document.getElementById('photoInput');
                    if (photoInput) {
                        photoInput.addEventListener('change', this.handlePhotoPreview);
                    }

                    // Form submission
                    const form = document.getElementById('galleryForm');
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

                applyFilters(searchTerm = '') {
                    const statusFilter = document.getElementById('statusFilter')?.value || '';
                    const term = searchTerm.trim().toLowerCase();

                    this.filteredData = this.data.filter(item => {
                        const matchesSearch = item.description.toLowerCase().includes(term);
                        const matchesStatus = statusFilter ? item.status === statusFilter : true;
                        return matchesSearch && matchesStatus;
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
                    const tableBody = document.getElementById('galleryTableBody');
                    if (!tableBody) return;

                    tableBody.innerHTML = '';

                    const start = (this.currentPage - 1) * this.perPage;
                    const pageItems = this.filteredData.slice(start, start + this.perPage);

                    if (pageItems.length === 0) {
                        tableBody.innerHTML = `
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Tidak ada foto {{$title}}
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

                    // Checkbox
                    const tdCheckbox = document.createElement('td');
                    tdCheckbox.className = 'px-6 py-4 whitespace-nowrap';
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.className = 'row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500';
                    checkbox.dataset.id = item.id;
                    checkbox.checked = this.selectedIds.has(item.id);
                    checkbox.addEventListener('change', () => {
                        if (checkbox.checked) {
                            this.selectedIds.add(item.id);
                        } else {
                            this.selectedIds.delete(item.id);
                        }
                        this.updateSelectedCount();
                        this.updateSelectAllState();
                    });
                    tdCheckbox.appendChild(checkbox);
                    tr.appendChild(tdCheckbox);

                    // Photo Preview
                    const tdPreview = document.createElement('td');
                    tdPreview.className = 'px-6 py-4 whitespace-nowrap';
                    const img = document.createElement('img');
                    img.src = item.src;
                    img.alt = item.description;
                    img.className = 'h-16 w-20 rounded object-cover shadow-sm';
                    tdPreview.appendChild(img);
                    tr.appendChild(tdPreview);

                    // Description
                    const tdDesc = document.createElement('td');
                    tdDesc.className = 'px-6 py-4 max-w-xs';
                    const descDiv = document.createElement('div');
                    descDiv.className = 'text-sm text-gray-900 break-words';
                    descDiv.textContent = item.description;
                    tdDesc.appendChild(descDiv);
                    tr.appendChild(tdDesc);

                    // Status
                    const tdStatus = document.createElement('td');
                    tdStatus.className = 'px-6 py-4 whitespace-nowrap';
                    const statusSpan = this.createStatusBadge(item.status);
                    tdStatus.appendChild(statusSpan);
                    tr.appendChild(tdStatus);

                    // Date
                    const tdDate = document.createElement('td');
                    tdDate.className = 'px-6 py-4 whitespace-nowrap text-sm text-gray-500';
                    tdDate.innerHTML = `
                            <div>Dibuat: ${item.created_at}</div>
                            <div>Update: ${item.updated_at}</div>
                        `;
                    tr.appendChild(tdDate);

                    // Actions
                    const tdActions = document.createElement('td');
                    tdActions.className = 'px-6 py-4 whitespace-nowrap text-sm font-medium';
                    tdActions.innerHTML = `
                            <div class="flex items-center space-x-2">
                                <button onclick="previewGallery(${item.id})" class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Preview">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="editGallery(${item.id})" class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteGallery(${item.id})" class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        `;
                    tr.appendChild(tdActions);

                    return tr;
                },

                createStatusBadge(status) {
                    const span = document.createElement('span');
                    span.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';

                    const dot = document.createElement('div');
                    dot.className = 'w-1.5 h-1.5 rounded-full mr-1.5';

                    switch (status) {
                        case 'published':
                            span.classList.add('bg-green-100', 'text-green-800');
                            dot.classList.add('bg-green-400');
                            span.textContent = 'Published';
                            break;
                        case 'draft':
                            span.classList.add('bg-yellow-100', 'text-yellow-800');
                            dot.classList.add('bg-yellow-400');
                            span.textContent = 'Draft';
                            break;
                        case 'archived':
                            span.classList.add('bg-gray-100', 'text-gray-800');
                            dot.classList.add('bg-gray-400');
                            span.textContent = 'Archived';
                            break;
                        default:
                            span.classList.add('bg-gray-100', 'text-gray-800');
                            dot.classList.add('bg-gray-400');
                            span.textContent = status;
                    }

                    span.insertBefore(dot, span.firstChild);
                    return span;
                },

                renderPagination() {
                    const totalPages = Math.ceil(this.filteredData.length / this.perPage);
                    const paginationInfo = document.getElementById('galleryPaginationInfo');
                    const paginationControls = document.getElementById('galleryPaginationControls');
                    const paginationControlsMobile = document.getElementById('galleryPaginationControlsMobile');

                    if (paginationInfo) {
                        const start = (this.currentPage - 1) * this.perPage + 1;
                        const end = Math.min(this.currentPage * this.perPage, this.filteredData.length);
                        paginationInfo.textContent =
                            `Menampilkan ${start} sampai ${end} dari ${this.filteredData.length} foto`;
                    }

                    // Desktop pagination
                    if (paginationControls) {
                        paginationControls.innerHTML = '';
                        if (totalPages > 1) {
                            // Previous button
                            const prevBtn = this.createPaginationButton('Sebelumnya', this.currentPage - 1, this
                                .currentPage === 1);
                            paginationControls.appendChild(prevBtn);

                            // Page numbers
                            for (let i = 1; i <= totalPages; i++) {
                                const pageBtn = this.createPaginationButton(i.toString(), i, false, i === this
                                    .currentPage);
                                paginationControls.appendChild(pageBtn);
                            }

                            // Next button
                            const nextBtn = this.createPaginationButton('Selanjutnya', this.currentPage + 1, this
                                .currentPage === totalPages);
                            paginationControls.appendChild(nextBtn);
                        }
                    }

                    // Mobile pagination
                    if (paginationControlsMobile) {
                        paginationControlsMobile.innerHTML = '';
                        if (totalPages > 1) {
                            // Previous button
                            const prevBtn = this.createPaginationButton('‹', this.currentPage - 1, this
                                .currentPage === 1, false, true);
                            paginationControlsMobile.appendChild(prevBtn);

                            // Page numbers (limited for mobile)
                            const startPage = Math.max(1, this.currentPage - 1);
                            const endPage = Math.min(totalPages, this.currentPage + 1);

                            for (let i = startPage; i <= endPage; i++) {
                                const pageBtn = this.createPaginationButton(i.toString(), i, false, i === this
                                    .currentPage, true);
                                paginationControlsMobile.appendChild(pageBtn);
                            }

                            // Next button
                            const nextBtn = this.createPaginationButton('›', this.currentPage + 1, this
                                .currentPage === totalPages, false, true);
                            paginationControlsMobile.appendChild(nextBtn);
                        }
                    }
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
                        pageItems.forEach(item => {
                            this.selectedIds.add(item.id);
                        });
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
                    const countElement = document.getElementById('gallerySelectedCount');
                    const bulkApplyBtn = document.getElementById('galleryBulkApply');
                    const bulkActionSelect = document.getElementById('galleryBulkAction');

                    if (countElement) {
                        countElement.textContent = `${count} foto dipilih`;
                    }

                    if (bulkApplyBtn) {
                        bulkApplyBtn.disabled = count === 0 || !bulkActionSelect?.value;
                    }
                },

                applyBulkAction() {
                    const action = document.getElementById('galleryBulkAction')?.value;
                    const count = this.selectedIds.size;

                    if (!action) {
                        alert('Pilih aksi yang akan diterapkan');
                        return;
                    }

                    if (count === 0) {
                        alert('Pilih minimal 1 foto untuk melakukan aksi bulk');
                        return;
                    }

                    const actionTexts = {
                        'publish': 'publikasikan',
                        'draft': 'jadikan draft',
                        'archive': 'arsipkan',
                        'delete': 'hapus'
                    };

                    const actionText = actionTexts[action] || action;

                    if (confirm(`Apakah Anda yakin ingin ${actionText} ${count} foto yang dipilih?`)) {
                        console.log('Bulk action:', action, 'IDs:', Array.from(this.selectedIds));
                        alert(`${count} foto berhasil ${actionText}! (Demo)`);

                        // Reset selections
                        this.selectedIds.clear();
                        document.getElementById('selectAll').checked = false;
                        document.getElementById('galleryBulkAction').value = '';
                        this.updateSelectedCount();
                        this.render();
                    }
                },

                handlePhotoPreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewImage = document.getElementById('previewImage');
                            const photoPreview = document.getElementById('photoPreview');
                            const uploadPlaceholder = document.getElementById('uploadPlaceholder');

                            if (previewImage && photoPreview && uploadPlaceholder) {
                                previewImage.src = e.target.result;
                                photoPreview.classList.remove('hidden');
                                uploadPlaceholder.classList.add('hidden');
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                },

                handleFormSubmit(event) {
                    event.preventDefault();

                    const formData = new FormData(event.target);
                    const photo = formData.get('photo');
                    const description = formData.get('description');
                    const status = formData.get('status');

                    if (!photo || !photo.name) {
                        alert('Silakan pilih foto untuk diunggah');
                        return;
                    }

                    if (!description.trim()) {
                        alert('Deskripsi kegiatan tidak boleh kosong');
                        return;
                    }

                    console.log('Form data:', {
                        photo: photo.name,
                        description: description,
                        status: status
                    });

                    this.closeGalleryModal();
                    alert('Foto {{$title}} berhasil disimpan! (Demo)');
                },

                closeAllModals() {
                    this.closeGalleryModal();
                    this.closeGalleryPreviewModal();
                },

                closeGalleryModal() {
                    const modal = document.getElementById('galleryModal');
                    if (modal) {
                        modal.classList.add('hidden');

                        // Reset form
                        const form = document.getElementById('galleryForm');
                        if (form) {
                            form.reset();
                        }

                        // Reset photo preview
                        const photoPreview = document.getElementById('photoPreview');
                        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
                        if (photoPreview && uploadPlaceholder) {
                            photoPreview.classList.add('hidden');
                            uploadPlaceholder.classList.remove('hidden');
                        }
                    }
                },

                closeGalleryPreviewModal() {
                    const modal = document.getElementById('galleryPreviewModal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                },

                openGalleryModal() {
                    const modal = document.getElementById('galleryModal');
                    if (modal) {
                        modal.classList.remove('hidden');
                        document.getElementById('galleryModalTitle').textContent = 'Tambah Foto {{$title}}';
                    }
                },

                previewGallery(id) {
                    const item = this.data.find(item => item.id == id);
                    if (item) {
                        const modal = document.getElementById('galleryPreviewModal');
                        const image = document.getElementById('previewModalImage');
                        const description = document.getElementById('previewModalDescription');

                        if (modal && image && description) {
                            image.src = item.src;
                            image.alt = item.description;
                            description.textContent = item.description;
                            modal.classList.remove('hidden');
                        }
                    }
                },

                editGallery(id) {
                    console.log('Edit gallery:', id);
                    this.openGalleryModal();
                    document.getElementById('galleryModalTitle').textContent = 'Edit Foto {{$title}}';
                    // TODO: Load existing data for editing
                },

                deleteGallery(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                        console.log('Delete gallery:', id);
                        alert('Foto berhasil dihapus! (Demo)');
                        // TODO: Implement actual delete functionality
                    }
                }
            };

            // Global functions
            window.openGalleryModal = () => GalleryManager.openGalleryModal();
            window.closeGalleryModal = () => GalleryManager.closeGalleryModal();
            window.closeGalleryPreviewModal = () => GalleryManager.closeGalleryPreviewModal();
            window.previewGallery = (id) => GalleryManager.previewGallery(id);
            window.editGallery = (id) => GalleryManager.editGallery(id);
            window.deleteGallery = (id) => GalleryManager.deleteGallery(id);

            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', () => {
                GalleryManager.init();
            });

        })();
    </script>
</x-admin.layouts>
