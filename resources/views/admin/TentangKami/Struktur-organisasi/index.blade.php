<!-- resources/views/admin/manage-content/about/profil.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- @section('page-title', 'Struktur Organisasi PUSTIPD')
    @section('page-description', 'Kelola Struktur Organisasi PUSTIPD')
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
                                                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Struktur Organisasi PUSTIPD</span>
                                                </div>
                                            </li>
    @endsection -->

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Struktur {{ $title }}</h2>
                <p class="text-gray-600 mt-1">Kelola struktur kepemimpinan dan divisi PUSTIPD</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button onclick="previewCarousel()"
                    class="w-full sm:w-auto bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Preview Carousel
                </button>
                <button onclick="previewOrgChart()"
                    class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                    </svg>
                    Preview Tree
                </button>
                <button onclick="saveOrganization()"
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>

        <form id="organizationForm">
            <!-- Deskripsi Utama -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Deskripsi {{ $title }}</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">General Info</span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="orgName" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama {{ $title }}
                        </label>
                        <input type="text" id="orgName" name="orgName" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="PUSTIPD UIN Raden Fatah Palembang">
                    </div>

                    <div>
                        <label for="orgDescription" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi {{ $title }}
                        </label>
                        <textarea id="orgDescription" name="orgDescription" rows="3" required
                            class="w-full px-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                            placeholder="Deskripsi singkat tentang PUSTIPD dan perannya..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Kepala Organisasi -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Kepala PUSTIPD</h3>
                    <span class="text-xs text-gray-500 bg-red-100 px-2 py-1 rounded">Single Entry</span>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Foto Kepala</label>
                            <div class="flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4 overflow-hidden"
                                    id="headPhotoPreview">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <img id="headPhotoImg" class="w-full h-full object-cover hidden" src=""
                                        alt="">
                                </div>
                                <input type="file" id="headPhoto" name="headPhoto" accept="image/*" class="hidden"
                                    required>
                                <button type="button" onclick="document.getElementById('headPhoto').click()"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                                    Upload Foto
                                </button>
                            </div>
                        </div>

                        <!-- Head Info -->
                        <div class="space-y-4">
                            <div>
                                <label for="headName" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="headName" name="headName" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Dr. Nama Kepala, M.T.">
                            </div>

                            <div>
                                <label for="headPosition"
                                    class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                <input type="text" id="headPosition" name="headPosition" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Kepala PUSTIPD" readonly>
                            </div>

                            <div>
                                <label for="headEmail"
                                    class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="headEmail" name="headEmail"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="kepala@pustipd.uinrf.ac.id">
                            </div>

                            <div>
                                <label for="headOrder" class="block text-sm font-medium text-gray-700 mb-2">Urutan
                                    Tampilan</label>
                                <input type="number" id="headOrder" name="headOrder" value="0" readonly
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-500"
                                    placeholder="0 (Selalu di posisi pertama)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divisi Management -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Divisi & Staff</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 bg-green-100 px-2 py-1 rounded">Multiple
                            Entries</span>
                        <button type="button" onclick="addDivisionEntry()"
                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Divisi
                        </button>
                    </div>
                </div>

                <!-- Divisions Container -->
                <div id="divisionsContainer" class="space-y-6">
                    <!-- Division entries akan ditambahkan di sini -->
                </div>

                <!-- Empty State -->
                <div id="divisionsEmptyState"
                    class="text-center py-8 border-2 border-dashed border-gray-200 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm mb-3">Belum ada divisi yang ditambahkan</p>
                    <button type="button" onclick="addDivisionEntry()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Tambah Divisi Pertama
                    </button>
                </div>
            </div>

            <!-- Status Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500 mr-2">Terakhir disimpan:</span>
                        <span id="lastSavedTime" class="text-xs text-green-600 font-medium">Belum disimpan</span>
                    </div>
                </div>
                <select id="status" name="status" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="draft">Draft - Belum dipublikasikan</option>
                    <option value="published">Published - Tampil di website</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Carousel Preview Modal -->
    <div id="carouselPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeCarouselPreview()">
            </div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="text-center mb-6">
                        <h3 class="text-xl leading-6 font-bold text-gray-900">Preview Carousel - Beranda</h3>
                        <p class="text-sm text-gray-600 mt-2">Tampilan carousel struktur {{ $title }} di beranda
                            website
                        </p>
                    </div>

                    <!-- Carousel Container -->
                    <div class="relative">
                        <div id="carouselContent" class="flex overflow-x-auto space-x-6 pb-4">
                            <!-- Carousel items akan diisi oleh JavaScript -->
                        </div>

                        <!-- Carousel Navigation -->
                        <div class="flex justify-center mt-4 space-x-2">
                            <button id="carouselPrev"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 p-2 rounded-full transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button id="carouselNext"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 p-2 rounded-full transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeCarouselPreview()"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                        Tutup Preview
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Organization Chart Preview Modal -->
    <div id="orgChartPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeOrgChartPreview()">
            </div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="text-center mb-6">
                        <h3 class="text-xl leading-6 font-bold text-gray-900">Preview {{ $title }} Chart</h3>
                        <p class="text-sm text-gray-600 mt-2">Tampilan tree struktur {{ $title }} di halaman
                            khusus</p>
                    </div>

                    <!-- Organization Chart Container -->
                    <div class="overflow-x-auto">
                        <div id="orgChartContent" class="min-w-max">
                            <!-- Organization chart akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeOrgChartPreview()"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                        Tutup Preview
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';

            const OrganizationManager = {
                divisionCounter: 0,
                organizationData: {
                    name: '',
                    description: '',
                    head: {},
                    divisions: []
                },

                init() {
                    this.loadExistingData();
                    this.bindEvents();
                    this.updateUI();
                },

                loadExistingData() {
                    // Load existing data (dalam implementasi nyata, data akan dimuat dari server)
                    this.organizationData = {
                        name: 'PUSTIPD UIN Raden Fatah Palembang',
                        description: 'Pusat Teknologi Informasi dan Pangkalan Data yang bertanggung jawab dalam pengembangan sistem informasi dan pelayanan digital universitas.',
                        head: {
                            name: 'Dr. Ahmad Zubair, M.T.',
                            position: 'Kepala PUSTIPD',
                            email: 'kepala@pustipd.uinrf.ac.id',
                            photo: 'https://via.placeholder.com/200x200?text=Kepala',
                            order: 0
                        },
                        divisions: [{
                                id: 1,
                                name: 'Divisi Pengembangan Perangkat Lunak',
                                staff: [{
                                        name: 'Budi Santoso, S.Kom',
                                        position: 'Kepala Divisi',
                                        email: 'budi@pustipd.uinrf.ac.id',
                                        photo: 'https://via.placeholder.com/200x200?text=Budi',
                                        order: 1
                                    },
                                    {
                                        name: 'Sari Wulandari, S.T.',
                                        position: 'Programmer',
                                        email: 'sari@pustipd.uinrf.ac.id',
                                        photo: 'https://via.placeholder.com/200x200?text=Sari',
                                        order: 2
                                    }
                                ]
                            },
                            {
                                id: 2,
                                name: 'Divisi Jaringan dan Infrastruktur',
                                staff: [{
                                    name: 'Eko Prasetyo, S.T.',
                                    position: 'Kepala Divisi',
                                    email: 'eko@pustipd.uinrf.ac.id',
                                    photo: 'https://via.placeholder.com/200x200?text=Eko',
                                    order: 3
                                }]
                            }
                        ]
                    };

                    // Populate form with existing data
                    document.getElementById('orgName').value = this.organizationData.name;
                    document.getElementById('orgDescription').value = this.organizationData.description;
                    document.getElementById('headName').value = this.organizationData.head.name;
                    document.getElementById('headPosition').value = this.organizationData.head.position;
                    document.getElementById('headEmail').value = this.organizationData.head.email;

                    // Load head photo
                    if (this.organizationData.head.photo) {
                        this.displayHeadPhoto(this.organizationData.head.photo);
                    }

                    // Load existing divisions
                    this.organizationData.divisions.forEach(division => {
                        this.addDivisionEntry(division.name, division.staff, division.id);
                    });
                },

                bindEvents() {
                    // Head photo upload
                    const headPhotoInput = document.getElementById('headPhoto');
                    if (headPhotoInput) {
                        headPhotoInput.addEventListener('change', (e) => {
                            this.handlePhotoUpload(e, 'head');
                        });
                    }

                    // Form auto-save
                    setInterval(() => {
                        this.autoSave();
                    }, 30000);
                },

                displayHeadPhoto(src) {
                    const previewDiv = document.getElementById('headPhotoPreview');
                    const img = document.getElementById('headPhotoImg');
                    const svg = previewDiv.querySelector('svg');

                    if (img && svg) {
                        img.src = src;
                        img.classList.remove('hidden');
                        svg.style.display = 'none';
                    }
                },

                handlePhotoUpload(event, type, divisionId = null, staffIndex = null) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            if (type === 'head') {
                                this.displayHeadPhoto(e.target.result);
                            } else if (type === 'staff') {
                                this.displayStaffPhoto(e.target.result, divisionId, staffIndex);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                },

                displayStaffPhoto(src, divisionId, staffIndex) {
                    const img = document.getElementById(`staffPhoto_${divisionId}_${staffIndex}`);
                    const svg = document.querySelector(`#staffPhotoPreview_${divisionId}_${staffIndex} svg`);

                    if (img && svg) {
                        img.src = src;
                        img.classList.remove('hidden');
                        svg.style.display = 'none';
                    }
                },

                addDivisionEntry(existingName = '', existingStaff = [], divisionId = null) {
                    this.divisionCounter++;
                    const id = divisionId || this.divisionCounter;
                    const container = document.getElementById('divisionsContainer');
                    const emptyState = document.getElementById('divisionsEmptyState');

                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }

                    const divisionDiv = document.createElement('div');
                    divisionDiv.className =
                        'division-entry bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-6';
                    divisionDiv.dataset.divisionId = id;

                    divisionDiv.innerHTML = `
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold mr-3">${id}</div>
                                <h4 class="text-base font-semibold text-gray-900">Divisi ${id}</h4>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="OrganizationManager.moveDivision(${id}, 'up')" 
                                        class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-200" title="Pindah ke atas">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 14l5-5 5 5"></path>
                                    </svg>
                                </button>
                                <button type="button" onclick="OrganizationManager.moveDivision(${id}, 'down')" 
                                        class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-200" title="Pindah ke bawah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 10l-5 5-5-5"></path>
                                    </svg>
                                </button>
                                <button type="button" onclick="OrganizationManager.deleteDivision(${id})" 
                                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Divisi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
        
                        <!-- Division Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Divisi</label>
                            <input type="text" name="division_name_${id}" id="division_name_${id}" required
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Contoh: Divisi Pengembangan Perangkat Lunak" value="${existingName}">
                        </div>
        
                        <!-- Staff Management -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h5 class="text-sm font-medium text-gray-700">Staff Divisi</h5>
                                <button type="button" onclick="OrganizationManager.addStaffEntry(${id})" 
                                        class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center text-xs">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah Staff
                                </button>
                            </div>
                            
                            <div id="staffContainer_${id}" class="space-y-4">
                                <!-- Staff entries akan ditambahkan di sini -->
                            </div>
                        </div>
                    `;

                    container.appendChild(divisionDiv);

                    // Add existing staff
                    if (existingStaff && existingStaff.length > 0) {
                        existingStaff.forEach((staff, index) => {
                            this.addStaffEntry(id, staff.name, staff.position, staff.email, staff.photo,
                                staff.order);
                        });
                    }

                    this.updateUI();
                },

                addStaffEntry(divisionId, existingName = '', existingPosition = '', existingEmail = '',
                    existingPhoto = '', existingOrder = '') {
                    const staffContainer = document.getElementById(`staffContainer_${divisionId}`);
                    const staffCount = staffContainer.children.length;
                    const staffIndex = staffCount;

                    const staffDiv = document.createElement('div');
                    staffDiv.className = 'staff-entry bg-white border border-gray-200 rounded-lg p-4';
                    staffDiv.dataset.staffIndex = staffIndex;

                    staffDiv.innerHTML = `
                        <div class="flex items-center justify-between mb-3">
                            <h6 class="text-sm font-medium text-gray-800">Staff ${staffIndex + 1}</h6>
                            <button type="button" onclick="OrganizationManager.removeStaffEntry(${divisionId}, ${staffIndex})" 
                                    class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Staff">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Photo -->
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-2 overflow-hidden" id="staffPhotoPreview_${divisionId}_${staffIndex}">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <img id="staffPhoto_${divisionId}_${staffIndex}" class="w-full h-full object-cover hidden" src="${existingPhoto}" alt="">
                                    </div>
                                    <input type="file" id="staffPhotoInput_${divisionId}_${staffIndex}" name="staff_photo_${divisionId}_${staffIndex}" accept="image/*" class="hidden">
                                    <button type="button" onclick="document.getElementById('staffPhotoInput_${divisionId}_${staffIndex}').click()" 
                                            class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700 transition-colors duration-200">
                                        Upload
                                    </button>
                                </div>
                            </div>
        
                            <!-- Info -->
                            <div class="md:col-span-2 space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="staff_name_${divisionId}_${staffIndex}" required
                                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                           placeholder="Nama lengkap staff" value="${existingName}">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                                    <input type="text" name="staff_position_${divisionId}_${staffIndex}" required
                                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                           placeholder="Jabatan/posisi" value="${existingPosition}">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" name="staff_email_${divisionId}_${staffIndex}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                               placeholder="email@pustipd.uinrf.ac.id" value="${existingEmail}">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                                        <input type="number" name="staff_order_${divisionId}_${staffIndex}" min="1"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                               placeholder="1" value="${existingOrder || staffIndex + 1}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    staffContainer.appendChild(staffDiv);

                    // Bind photo upload event
                    const photoInput = document.getElementById(`staffPhotoInput_${divisionId}_${staffIndex}`);
                    if (photoInput) {
                        photoInput.addEventListener('change', (e) => {
                            this.handlePhotoUpload(e, 'staff', divisionId, staffIndex);
                        });
                    }

                    // Display existing photo if available
                    if (existingPhoto) {
                        this.displayStaffPhoto(existingPhoto, divisionId, staffIndex);
                    }
                },

                removeStaffEntry(divisionId, staffIndex) {
                    if (confirm('Apakah Anda yakin ingin menghapus staff ini?')) {
                        const staffDiv = document.querySelector(
                            `[data-division-id="${divisionId}"] [data-staff-index="${staffIndex}"]`);
                        if (staffDiv) {
                            staffDiv.remove();
                        }
                    }
                },

                deleteDivision(divisionId) {
                    if (confirm('Apakah Anda yakin ingin menghapus divisi ini beserta seluruh staff-nya?')) {
                        const divisionDiv = document.querySelector(`[data-division-id="${divisionId}"]`);
                        if (divisionDiv) {
                            divisionDiv.remove();
                            this.reorderDivisions();
                            this.updateUI();
                        }
                    }
                },

                moveDivision(divisionId, direction) {
                    const divisionDiv = document.querySelector(`[data-division-id="${divisionId}"]`);
                    if (!divisionDiv) return;

                    const container = divisionDiv.parentNode;

                    if (direction === 'up') {
                        const prevDiv = divisionDiv.previousElementSibling;
                        if (prevDiv) {
                            container.insertBefore(divisionDiv, prevDiv);
                        }
                    } else if (direction === 'down') {
                        const nextDiv = divisionDiv.nextElementSibling;
                        if (nextDiv) {
                            container.insertBefore(nextDiv, divisionDiv);
                        }
                    }

                    this.reorderDivisions();
                },

                reorderDivisions() {
                    const divisionEntries = document.querySelectorAll('.division-entry');
                    divisionEntries.forEach((entry, index) => {
                        const newNumber = index + 1;
                        const oldId = entry.dataset.divisionId;

                        // Update data attribute
                        entry.dataset.divisionId = newNumber;

                        // Update number badge
                        const badge = entry.querySelector('.w-8.h-8');
                        if (badge) {
                            badge.textContent = newNumber;
                        }

                        // Update title
                        const title = entry.querySelector('h4');
                        if (title) {
                            title.textContent = `Divisi ${newNumber}`;
                        }

                        // Update all form elements with new IDs
                        const elements = entry.querySelectorAll('[name], [id]');
                        elements.forEach(element => {
                            if (element.name) {
                                element.name = element.name.replace(/_\d+_/, `_${newNumber}_`)
                                    .replace(/_\d+$/, `_${newNumber}`);
                            }
                            if (element.id) {
                                element.id = element.id.replace(/_\d+_/, `_${newNumber}_`).replace(
                                    /_\d+$/, `_${newNumber}`);
                            }
                        });

                        // Update onclick handlers
                        const buttons = entry.querySelectorAll('[onclick]');
                        buttons.forEach(button => {
                            const onclick = button.getAttribute('onclick');
                            button.setAttribute('onclick', onclick.replace(/\d+/g, newNumber));
                        });
                    });
                },

                updateUI() {
                    const divisionEntries = document.querySelectorAll('.division-entry');
                    const emptyState = document.getElementById('divisionsEmptyState');

                    if (divisionEntries.length === 0) {
                        if (emptyState) {
                            emptyState.style.display = 'block';
                        }
                    } else {
                        if (emptyState) {
                            emptyState.style.display = 'none';
                        }
                    }
                },

                collectFormData() {
                    const formData = {
                        name: document.getElementById('orgName').value.trim(),
                        description: document.getElementById('orgDescription').value.trim(),
                        head: {
                            name: document.getElementById('headName').value.trim(),
                            position: document.getElementById('headPosition').value.trim(),
                            email: document.getElementById('headEmail').value.trim(),
                            photo: document.getElementById('headPhotoImg').src || '',
                            order: 0
                        },
                        divisions: [],
                        status: document.getElementById('status').value,
                        updated_at: new Date().toISOString()
                    };

                    // Collect divisions data
                    const divisionEntries = document.querySelectorAll('.division-entry');
                    divisionEntries.forEach((divisionDiv, divisionIndex) => {
                        const divisionId = divisionDiv.dataset.divisionId;
                        const divisionName = document.getElementById(`division_name_${divisionId}`).value
                            .trim();

                        const staffEntries = divisionDiv.querySelectorAll('.staff-entry');
                        const staff = [];

                        staffEntries.forEach((staffDiv, staffIndex) => {
                            const staffName = staffDiv.querySelector(
                                `[name^="staff_name_${divisionId}_"]`).value.trim();
                            const staffPosition = staffDiv.querySelector(
                                `[name^="staff_position_${divisionId}_"]`).value.trim();
                            const staffEmail = staffDiv.querySelector(
                                `[name^="staff_email_${divisionId}_"]`).value.trim();
                            const staffOrder = staffDiv.querySelector(
                                `[name^="staff_order_${divisionId}_"]`).value || (staffIndex +
                                1);
                            const staffPhoto = staffDiv.querySelector(
                                `[id^="staffPhoto_${divisionId}_"]`).src || '';

                            if (staffName) {
                                staff.push({
                                    name: staffName,
                                    position: staffPosition,
                                    email: staffEmail,
                                    photo: staffPhoto,
                                    order: parseInt(staffOrder)
                                });
                            }
                        });

                        if (divisionName) {
                            formData.divisions.push({
                                id: parseInt(divisionId),
                                name: divisionName,
                                staff: staff.sort((a, b) => a.order - b.order)
                            });
                        }
                    });

                    return formData;
                },

                validateForm() {
                    const data = this.collectFormData();

                    if (!data.name) {
                        alert('Nama organisasi harus diisi');
                        document.getElementById('orgName').focus();
                        return false;
                    }

                    if (!data.description) {
                        alert('Deskripsi organisasi harus diisi');
                        document.getElementById('orgDescription').focus();
                        return false;
                    }

                    if (!data.head.name) {
                        alert('Nama kepala organisasi harus diisi');
                        document.getElementById('headName').focus();
                        return false;
                    }

                    if (data.divisions.length === 0) {
                        alert('Minimal harus ada 1 divisi');
                        return false;
                    }

                    // Validate divisions
                    for (let i = 0; i < data.divisions.length; i++) {
                        const division = data.divisions[i];
                        if (!division.name) {
                            alert(`Nama divisi ${i + 1} harus diisi`);
                            return false;
                        }

                        if (division.staff.length === 0) {
                            alert(`Divisi "${division.name}" harus memiliki minimal 1 staff`);
                            return false;
                        }

                        // Validate staff
                        for (let j = 0; j < division.staff.length; j++) {
                            const staff = division.staff[j];
                            if (!staff.name) {
                                alert(`Nama staff ${j + 1} di divisi "${division.name}" harus diisi`);
                                return false;
                            }
                            if (!staff.position) {
                                alert(`Jabatan staff "${staff.name}" di divisi "${division.name}" harus diisi`);
                                return false;
                            }
                        }
                    }

                    return true;
                },

                saveOrganization() {
                    if (!this.validateForm()) {
                        return;
                    }

                    const formData = this.collectFormData();
                    console.log('Saving Organization:', formData);

                    // Simulate API call
                    setTimeout(() => {
                        const lastSavedTime = document.getElementById('lastSavedTime');
                        if (lastSavedTime) {
                            lastSavedTime.textContent = new Date().toLocaleString('id-ID');
                            lastSavedTime.classList.remove('text-green-600');
                            lastSavedTime.classList.add('text-blue-600');
                        }

                        alert('Struktur organisasi berhasil disimpan!');
                    }, 1000);
                },

                autoSave() {
                    const formData = this.collectFormData();

                    if (formData.name && formData.head.name) {
                        console.log('Auto-saving...', formData);

                        const lastSavedTime = document.getElementById('lastSavedTime');
                        if (lastSavedTime) {
                            lastSavedTime.textContent = 'Auto-saved: ' + new Date().toLocaleTimeString('id-ID');
                            lastSavedTime.classList.remove('text-green-600', 'text-blue-600');
                            lastSavedTime.classList.add('text-gray-600');
                        }
                    }
                },

                previewCarousel() {
                    const formData = this.collectFormData();
                    const carouselContent = document.getElementById('carouselContent');

                    if (!carouselContent) return;

                    carouselContent.innerHTML = '';

                    // Create carousel items
                    const allMembers = [];

                    // Add head
                    allMembers.push({
                        name: formData.head.name,
                        position: formData.head.position,
                        email: formData.head.email,
                        photo: formData.head.photo,
                        order: 0,
                        division: 'Pimpinan'
                    });

                    // Add staff from all divisions
                    formData.divisions.forEach(division => {
                        division.staff.forEach(staff => {
                            allMembers.push({
                                name: staff.name,
                                position: staff.position,
                                email: staff.email,
                                photo: staff.photo,
                                order: staff.order,
                                division: division.name
                            });
                        });
                    });

                    // Sort by order
                    allMembers.sort((a, b) => a.order - b.order);

                    // Generate carousel items
                    allMembers.forEach(member => {
                        const memberCard = document.createElement('div');
                        memberCard.className = 'team-carousel-card flex-shrink-0';

                        memberCard.innerHTML = `
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-2 group w-56 sm:w-64 md:w-72">
                            <!-- Image Container -->
                            <div class="relative w-full h-48 sm:h-56 md:h-70 overflow-hidden">
                                ${
                                    member.photo
                                        ? `<img src="${member.photo}" alt="${member.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">`
                                        : `<div class="w-full h-full bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                                                        <span class="text-4xl sm:text-5xl md:text-6xl font-bold text-white">${
                                                                (member.name || '')
                                                                    .split(' ')
                                                                    .map(n => n[0])
                                                                    .join('')
                                                            }</span>
                                                    </div>`
                                }
                                <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Content Container -->
                            <div class="p-2 text-center h-20 sm:h-24 md:h-30 flex flex-col justify-center">
                                <h3 class="text-lg sm:text-xl font-bold text-secondary mb-1 group-hover:text-custom-blue transition-colors duration-300">${member.name}</h3>
                                <h4 class="text-sm sm:text-base text-secondary font-medium mb-2 sm:mb-3">${member.position}</h4>
                            </div>
                        </div>
                    `;
                        carouselContent.appendChild(memberCard);
                    });

                    // Show modal
                    const modal = document.getElementById('carouselPreviewModal');
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                },

                previewOrgChart() {
                    const formData = this.collectFormData();
                    const orgChartContent = document.getElementById('orgChartContent');

                    if (!orgChartContent) return;

                    orgChartContent.innerHTML = '';

                    // Create organization chart structure
                    const chartContainer = document.createElement('div');
                    chartContainer.className = 'flex flex-col items-center space-y-8 p-8';

                    // Head node
                    const headNode = document.createElement('div');
                    headNode.className = 'text-center';
                    headNode.innerHTML = `
                        <div class="bg-blue-600 text-white rounded-xl p-6 shadow-lg mb-4 relative">
                            <div class="w-20 h-20 mx-auto mb-3 rounded-full overflow-hidden bg-blue-800">
                                ${formData.head.photo ? 
                                    `<img src="${formData.head.photo}" alt="${formData.head.name}" class="w-full h-full object-cover">` :
                                    `<div class="w-full h-full flex items-center justify-center">
                                                                                    <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                                    </svg>
                                                                                </div>`
                                }
                            </div>
                            <h3 class="text-lg font-bold mb-1">${formData.head.name}</h3>
                            <p class="text-blue-200 text-sm">${formData.head.position}</p>
                        </div>
                    `;

                    chartContainer.appendChild(headNode);

                    // Connection lines and divisions
                    if (formData.divisions.length > 0) {
                        // Main connection line
                        const mainLine = document.createElement('div');
                        mainLine.className = 'w-px h-12 bg-gray-400';
                        chartContainer.appendChild(mainLine);

                        // Horizontal connector
                        const horizontalConnector = document.createElement('div');
                        horizontalConnector.className = 'flex items-center justify-center relative';

                        const horizontalLine = document.createElement('div');
                        horizontalLine.className = `h-px bg-gray-400`;
                        horizontalLine.style.width = `${formData.divisions.length * 300}px`;
                        horizontalConnector.appendChild(horizontalLine);

                        chartContainer.appendChild(horizontalConnector);

                        // Division nodes
                        const divisionsContainer = document.createElement('div');
                        divisionsContainer.className = 'flex justify-center space-x-8';

                        formData.divisions.forEach(division => {
                            const divisionColumn = document.createElement('div');
                            divisionColumn.className = 'flex flex-col items-center space-y-4';

                            // Vertical connector
                            const verticalConnector = document.createElement('div');
                            verticalConnector.className = 'w-px h-8 bg-gray-400';
                            divisionColumn.appendChild(verticalConnector);

                            // Division header
                            const divisionHeader = document.createElement('div');
                            divisionHeader.className =
                                'bg-green-100 border-2 border-green-300 rounded-lg p-3 mb-4';
                            divisionHeader.innerHTML = `
                                <h4 class="text-sm font-semibold text-green-800 text-center max-w-48">${division.name}</h4>
                            `;
                            divisionColumn.appendChild(divisionHeader);

                            // Staff nodes
                            division.staff.forEach(staff => {
                                const staffNode = document.createElement('div');
                                staffNode.className =
                                    'bg-white border border-gray-300 rounded-lg p-4 shadow-sm';
                                staffNode.innerHTML = `
                                    <div class="text-center">
                                        <div class="w-16 h-16 mx-auto mb-2 rounded-full overflow-hidden bg-gray-200">
                                            ${staff.photo ? 
                                                `<img src="${staff.photo}" alt="${staff.name}" class="w-full h-full object-cover">` :
                                                `<div class="w-full h-full flex items-center justify-center">
                                                                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                                                </svg>
                                                                                            </div>`
                                            }
                                        </div>
                                        <h5 class="text-sm font-medium text-gray-900 mb-1">${staff.name}</h5>
                                        <p class="text-xs text-gray-600 max-w-32">${staff.position}</p>
                                    </div>
                                `;
                                divisionColumn.appendChild(staffNode);
                            });

                            divisionsContainer.appendChild(divisionColumn);
                        });

                        chartContainer.appendChild(divisionsContainer);
                    }

                    orgChartContent.appendChild(chartContainer);

                    // Show modal
                    const modal = document.getElementById('orgChartPreviewModal');
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                },

                closeCarouselPreview() {
                    const modal = document.getElementById('carouselPreviewModal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                },

                closeOrgChartPreview() {
                    const modal = document.getElementById('orgChartPreviewModal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                }
            };

            // Global functions
            window.addDivisionEntry = () => OrganizationManager.addDivisionEntry();
            window.saveOrganization = () => OrganizationManager.saveOrganization();
            window.previewCarousel = () => OrganizationManager.previewCarousel();
            window.previewOrgChart = () => OrganizationManager.previewOrgChart();
            window.closeCarouselPreview = () => OrganizationManager.closeCarouselPreview();
            window.closeOrgChartPreview = () => OrganizationManager.closeOrgChartPreview();

            // Make OrganizationManager globally accessible for onclick handlers
            window.OrganizationManager = OrganizationManager;

            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', () => {
                OrganizationManager.init();
            });

        })();
    </script>
</x-admin.layouts>
