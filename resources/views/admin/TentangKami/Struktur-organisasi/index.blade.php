<!-- resources/views/admin/TentangKami/Struktur-organisasi/index.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Struktur Organisasi PUSTIPD')
    @section('page-description', 'Kelola Struktur Organisasi PUSTIPD')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Content Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola Struktur {{ $title }}</h2>
                <p class="text-gray-600 mt-1">Kelola struktur kepemimpinan dan divisi PUSTIPD</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button onclick="previewCarousel()" type="button"
                    class="w-full sm:w-auto bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Preview Carousel
                </button>
                <button onclick="previewOrgChart()" type="button"
                    class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                    </svg>
                    Preview Tree
                </button>
                <button onclick="saveOrganization()" type="button"
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>

        <form id="organizationForm" enctype="multipart/form-data">
            @csrf

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
                            placeholder="PUSTIPD UIN Raden Fatah Palembang" value="{{ $organization['name'] ?? '' }}">
                    </div>

                    <div>
                        <label for="orgDescription" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi {{ $title }}
                        </label>
                        <textarea id="orgDescription" name="orgDescription" rows="3" required
                            class="w-full px-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                            placeholder="Deskripsi singkat tentang PUSTIPD dan perannya...">{{ $organization['description'] ?? '' }}</textarea>
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
                                    <img id="headPhotoImg" class="w-full h-full object-cover hidden"
                                        src="{{ $organization['head']['image'] ?? '' }}" alt="">
                                </div>
                                <input type="file" id="headPhoto" name="headPhoto" accept="image/*" class="hidden">
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
                                    placeholder="Nama Kepala Organisasi"
                                    value="{{ $organization['head']['nama'] ?? '' }}">
                            </div>

                            <div>
                                <label for="headPosition"
                                    class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                <input type="text" id="headPosition" name="headPosition" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Kepala PUSTIPD"
                                    value="{{ $organization['head']['jabatan'] ?? 'Kepala PUSTIPD' }}">
                            </div>

                            <div>
                                <label for="headEmail"
                                    class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="headEmail" name="headEmail"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="kepala@pustipd.uinrf.ac.id"
                                    value="{{ $organization['head']['email'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Tree Structure -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Preview Struktur Organisasi</h3>
                    <span class="text-xs text-gray-500 bg-yellow-100 px-2 py-1 rounded">Live Preview</span>
                </div>
                <div id="organizationTreeContainer" class="bg-gray-50 rounded-lg p-6 min-h-64">
                    <!-- Tree structure akan ditampilkan di sini -->
                    <div class="text-center text-gray-500 py-8">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p class="text-lg">Struktur Organisasi akan ditampilkan di sini</p>
                        <p class="text-sm">Tambahkan data kepala dan divisi untuk melihat preview</p>
                    </div>
                </div>
            </div>

            <!-- Divisi Management -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">Divisi & Staff</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 bg-green-100 px-2 py-1 rounded">Multiple Entries</span>
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
                <div id="divisionsContainer" class="space-y-6"></div>

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

    <!-- Modals sama seperti sebelumnya -->
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
                        <p class="text-sm text-gray-600 mt-2">Tampilan carousel struktur {{ $title }} di
                            beranda website</p>
                    </div>
                    <div class="relative">
                        <div id="carouselContent" class="flex overflow-x-auto space-x-6 pb-4">
                            <!-- Carousel items akan diisi oleh JavaScript -->
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
        // Route configuration
        window.routes = {
            'admin.tentang-kami.struktur-organisasi.store': '{{ route('admin.tentang-kami.struktur-organisasi.store') }}',
            'admin.tentang-kami.struktur-organisasi.get-data': '{{ route('admin.tentang-kami.struktur-organisasi.get-data') }}'
        };

        // Tree renderer class (keep existing)
        class OrgTreeRenderer {
            constructor(containerId) {
                this.container = document.getElementById(containerId);
            }

            render(data) {
                if (!this.container || !data) {
                    this.container.innerHTML = `
                    <div class="text-center text-gray-500 py-8">
                        <p class="text-lg">Belum ada data struktur organisasi</p>
                        <p class="text-sm">Tambahkan data kepala dan divisi untuk melihat preview</p>
                    </div>
                `;
                    return;
                }

                this.container.innerHTML = '';

                // Render Head
                if (data.head && data.head.nama) {
                    const headDiv = document.createElement('div');
                    headDiv.className = 'flex justify-center mb-8';
                    headDiv.innerHTML = `
                    <div class="text-center">
                        <img src="${data.head.image || '/assets/img/placeholder/dummy.png'}" alt="${data.head.nama}" class="mx-auto rounded-full w-32 h-32 object-cover border-4 border-blue-200" />
                        <h3 class="mt-4 text-xl font-semibold text-gray-800">${data.head.nama}</h3>
                        <p class="text-blue-600 font-medium">${data.head.jabatan}</p>
                        ${data.head.email ? `<p class="text-gray-600 text-sm">${data.head.email}</p>` : ''}
                    </div>
                `;
                    this.container.appendChild(headDiv);
                }

                // Render Divisions
                if (data.divisions && data.divisions.length > 0) {
                    data.divisions.forEach(division => {
                        const divSection = document.createElement('div');
                        divSection.className = 'mb-8';

                        const divTitle = document.createElement('h4');
                        divTitle.textContent = division.name;
                        divTitle.className =
                            'text-center text-xl font-bold text-primary mb-6 bg-blue-100 py-2 rounded-lg';
                        divSection.appendChild(divTitle);

                        if (division.members && division.members.length > 0) {
                            const membersGrid = document.createElement('div');
                            membersGrid.className =
                                'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4';

                            division.members.forEach(member => {
                                const memberCard = document.createElement('div');
                                memberCard.className =
                                    'bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition-shadow';

                                memberCard.innerHTML = `
                                <img src="${member.image || '/assets/img/placeholder/dummy.png'}" alt="${member.nama}" class="mx-auto rounded-full w-20 h-20 object-cover border-2 border-gray-200" />
                                <h5 class="mt-3 font-semibold text-gray-800">${member.nama}</h5>
                                <p class="text-gray-600 text-sm">${member.jabatan}</p>
                                ${member.email ? `<p class="text-blue-600 text-xs">${member.email}</p>` : ''}
                            `;

                                membersGrid.appendChild(memberCard);
                            });

                            divSection.appendChild(membersGrid);
                        }

                        this.container.appendChild(divSection);
                    });
                } else if (!data.head || !data.head.nama) {
                    this.container.innerHTML = `
                    <div class="text-center text-gray-500 py-8">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p class="text-lg">Belum ada data struktur organisasi</p>
                        <p class="text-sm">Tambahkan data kepala dan divisi untuk melihat preview</p>
                    </div>
                `;
                }
            }

            updateFromForm() {
                const data = this.collectFormData();
                this.render(data);
            }

            collectFormData() {
                const orgName = document.getElementById('orgName')?.value || '';
                const orgDescription = document.getElementById('orgDescription')?.value || '';
                const headName = document.getElementById('headName')?.value || '';
                const headPosition = document.getElementById('headPosition')?.value || '';
                const headEmail = document.getElementById('headEmail')?.value || '';
                const headPhoto = document.getElementById('headPhotoImg')?.src || '';

                const data = {
                    name: orgName,
                    description: orgDescription,
                    head: headName ? {
                        nama: headName,
                        jabatan: headPosition,
                        email: headEmail,
                        image: headPhoto
                    } : null,
                    divisions: []
                };

                // Collect divisions data
                const divisionEntries = document.querySelectorAll('.division-entry');
                divisionEntries.forEach(divisionDiv => {
                    const divisionId = divisionDiv.dataset.divisionId;
                    const divisionName = divisionDiv.querySelector(`[name="divisions[${divisionId}][name]"]`)
                        ?.value || '';

                    if (divisionName) {
                        const staffEntries = divisionDiv.querySelectorAll('.staff-entry');
                        const members = [];

                        staffEntries.forEach(staffDiv => {
                            const staffName = staffDiv.querySelector(`input[name*="[nama]"]`)?.value ||
                                '';
                            const staffPosition = staffDiv.querySelector(`input[name*="[jabatan]"]`)
                                ?.value || '';
                            const staffEmail = staffDiv.querySelector(`input[name*="[email]"]`)
                                ?.value || '';

                            if (staffName) {
                                members.push({
                                    nama: staffName,
                                    jabatan: staffPosition,
                                    email: staffEmail,
                                    image: '/assets/img/placeholder/dummy.png'
                                });
                            }
                        });

                        data.divisions.push({
                            name: divisionName,
                            members: members
                        });
                    }
                });

                return data;
            }
        }

        // Initialize tree renderer
        const treeRenderer = new OrgTreeRenderer('organizationTreeContainer');

        // Update preview when form data changes
        function updateTreePreview() {
            treeRenderer.updateFromForm();
        }

        // Bind events to update preview
        document.addEventListener('DOMContentLoaded', function() {
            // Initial render
            @if ($organization)
                treeRenderer.render(@json($organization));
            @endif

            // Update preview on input changes
            const inputs = ['orgName', 'orgDescription', 'headName', 'headPosition', 'headEmail'];
            inputs.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', updateTreePreview);
                }
            });

            // Head photo preview
            document.getElementById('headPhoto').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.getElementById('headPhotoImg');
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                        document.querySelector('#headPhotoPreview svg').style.display = 'none';
                        updateTreePreview();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Division counter - start fresh
        let divisionCount = 0;

        // Add division entry function (cleaned up)
        function addDivisionEntry(data = null) {
            divisionCount++;
            const container = document.getElementById('divisionsContainer');
            const emptyState = document.getElementById('divisionsEmptyState');

            emptyState.style.display = 'none';

            const divisionHtml = `
            <div class="division-entry bg-gray-50 rounded-lg p-6 border border-gray-200 mb-4" data-division-id="${divisionCount}">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-base font-semibold text-gray-900">Divisi ${divisionCount}</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="saveDivision(${divisionCount})" 
                                class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Divisi
                        </button>
                        <button type="button" onclick="removeDivision(${divisionCount})" 
                                class="text-red-600 hover:text-red-800 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Hapus Divisi
                        </button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Divisi</label>
                    <input type="text" name="divisions[${divisionCount}][name]" required
                           value="${data?.name || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="" onchange="updateTreePreview()">
                    <input type="hidden" name="divisions[${divisionCount}][order]" value="${divisionCount}">
                </div>
                
                <div class="members-container" id="membersContainer${divisionCount}">
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-medium text-gray-700">Anggota Divisi</label>
                        <button type="button" onclick="addMember(${divisionCount})" 
                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                            + Tambah Anggota
                        </button>
                    </div>
                    <div class="members-list space-y-3" id="membersList${divisionCount}">
                        <!-- Members will be added here -->
                    </div>
                </div>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', divisionHtml);

            // Add existing members if any (ONLY if data exists)
            if (data?.members && data.members.length > 0) {
                data.members.forEach((member, index) => {
                    addMember(divisionCount, member, index + 1);
                });
            }

            updateTreePreview();
        }

        function addMember(divisionId, data = null, memberIndex = null) {
            const membersList = document.getElementById(`membersList${divisionId}`);
            const currentMemberCount = membersList.children.length + 1;
            const memberNumber = memberIndex || currentMemberCount;

            const memberHtml = `
        <div class="staff-entry bg-white p-4 rounded-lg border border-gray-200" data-member-id="${memberNumber}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][nama]" required
                           value="${data?.nama || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                           placeholder="" onchange="updateTreePreview()">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][jabatan]" required
                           value="${data?.jabatan || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                           placeholder="" onchange="updateTreePreview()">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="divisions[${divisionId}][members][${memberNumber}][email]"
                           value="${data?.email || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                           placeholder="" onchange="updateTreePreview()">
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" name="divisions[${divisionId}][members][${memberNumber}][photo]" accept="image/*" class="text-sm">
                    </div>
                    <div id="memberSaveStatus${divisionId}_${memberNumber}" class="text-xs">
                        <!-- Save status will appear here -->
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    <button type="button" onclick="saveMember(${divisionId}, ${memberNumber})" 
                            class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" onclick="removeMember(this)" 
                            class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    `;

            membersList.insertAdjacentHTML('beforeend', memberHtml);
            updateTreePreview();
        }

        // Perbaiki juga function saveDivision untuk deteksi anggota yang benar:
        async function saveDivision(divisionId) {
            const divisionDiv = document.querySelector(`[data-division-id="${divisionId}"]`);
            const button = divisionDiv.querySelector('button[onclick*="saveDivision"]');
            const divisionName = divisionDiv.querySelector(`[name="divisions[${divisionId}][name]"]`).value;

            if (!divisionName) {
                showNotification('Nama divisi harus diisi', 'error');
                return;
            }

            // Check if division has members with proper data
            const members = divisionDiv.querySelectorAll('.staff-entry');
            let validMembers = 0;

            members.forEach(memberDiv => {
                const nama = memberDiv.querySelector(`input[name*="[nama]"]`)?.value || '';
                const jabatan = memberDiv.querySelector(`input[name*="[jabatan]"]`)?.value || '';

                if (nama.trim() && jabatan.trim()) {
                    validMembers++;
                }
            });

            if (validMembers === 0) {
                showNotification('Divisi harus memiliki minimal 1 anggota dengan nama dan jabatan yang terisi',
                    'error');
                return;
            }

            // Show loading
            button.disabled = true;
            button.innerHTML =
                '<svg class="w-4 h-4 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle></svg>Menyimpan...';

            try {
                const formData = new FormData();

                // Add organization data
                formData.append('orgName', document.getElementById('orgName').value || 'Struktur Organisasi');
                formData.append('orgDescription', document.getElementById('orgDescription').value || 'Deskripsi');
                formData.append('status', document.getElementById('status').value || 'draft');

                // Add head data if exists
                const headName = document.getElementById('headName').value;
                if (headName) {
                    formData.append('headName', headName);
                    formData.append('headPosition', document.getElementById('headPosition').value);
                    formData.append('headEmail', document.getElementById('headEmail').value);

                    const headPhoto = document.getElementById('headPhoto').files[0];
                    if (headPhoto) {
                        formData.append('headPhoto', headPhoto);
                    }
                }

                // Add division and all its members
                formData.append(`divisions[${divisionId}][name]`, divisionName);
                formData.append(`divisions[${divisionId}][order]`, divisionId);

                let memberCount = 1;
                members.forEach((memberDiv) => {
                    const memberNumber = memberDiv.dataset.memberId;
                    const nama = memberDiv.querySelector(`input[name*="[nama]"]`)?.value?.trim() || '';
                    const jabatan = memberDiv.querySelector(`input[name*="[jabatan]"]`)?.value?.trim() || '';
                    const email = memberDiv.querySelector(`input[name*="[email]"]`)?.value?.trim() || '';

                    // Only add members with valid data
                    if (nama && jabatan) {
                        formData.append(`divisions[${divisionId}][members][${memberCount}][nama]`, nama);
                        formData.append(`divisions[${divisionId}][members][${memberCount}][jabatan]`, jabatan);
                        formData.append(`divisions[${divisionId}][members][${memberCount}][email]`, email);
                        formData.append(`divisions[${divisionId}][members][${memberCount}][order]`,
                            memberCount);

                        const photoInput = memberDiv.querySelector('input[type="file"]');
                        if (photoInput && photoInput.files[0]) {
                            formData.append(`divisions[${divisionId}][members][${memberCount}][photo]`,
                                photoInput.files);
                        }

                        memberCount++;
                    }
                });

                console.log('Sending division data:', {
                    divisionId,
                    divisionName,
                    validMembers,
                    totalMembers: members.length
                });

                const response = await fetch(window.routes['admin.tentang-kami.struktur-organisasi.store'], {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(`Divisi ${divisionName} berhasil disimpan dengan ${validMembers} anggota`,
                        'success');

                    // Update save status for all valid members
                    members.forEach(memberDiv => {
                        const memberNumber = memberDiv.dataset.memberId;
                        const nama = memberDiv.querySelector(`input[name*="[nama]"]`)?.value?.trim() || '';
                        const jabatan = memberDiv.querySelector(`input[name*="[jabatan]"]`)?.value?.trim() ||
                            '';

                        if (nama && jabatan) {
                            const statusDiv = document.getElementById(
                                `memberSaveStatus${divisionId}_${memberNumber}`);
                            if (statusDiv) {
                                statusDiv.innerHTML = '<span class="text-green-600">✓ Tersimpan</span>';
                            }
                        }
                    });
                } else {
                    showNotification(result.message || 'Gagal menyimpan divisi', 'error');
                }
            } catch (error) {
                console.error('Error saving division:', error);
                showNotification('Terjadi kesalahan saat menyimpan', 'error');
            } finally {
                // Restore button
                button.disabled = false;
                button.innerHTML =
                    '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Simpan Divisi';
            }
        }

        // Perbaiki juga function saveMember untuk validasi yang lebih baik:
        async function saveMember(divisionId, memberNumber) {
            const memberDiv = document.querySelector(`[data-member-id="${memberNumber}"]`);
            const button = memberDiv.querySelector('button[onclick*="saveMember"]');
            const statusDiv = document.getElementById(`memberSaveStatus${divisionId}_${memberNumber}`);

            // Get member data
            const nama = memberDiv.querySelector(`input[name*="[nama]"]`)?.value?.trim() || '';
            const jabatan = memberDiv.querySelector(`input[name*="[jabatan]"]`)?.value?.trim() || '';
            const email = memberDiv.querySelector(`input[name*="[email]"]`)?.value?.trim() || '';

            if (!nama || !jabatan) {
                showNotification('Nama dan Jabatan harus diisi', 'error');
                statusDiv.innerHTML = '<span class="text-red-600">✗ Data tidak lengkap</span>';
                return;
            }

            // Show loading
            button.disabled = true;
            button.innerHTML =
                '<svg class="w-3 h-3 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle></svg>Simpan...';
            statusDiv.innerHTML = '<span class="text-blue-600">Menyimpan...</span>';

            try {
                // Create FormData for this member
                const formData = new FormData();

                // Add required organization data
                formData.append('orgName', document.getElementById('orgName').value || 'Struktur Organisasi');
                formData.append('orgDescription', document.getElementById('orgDescription').value || 'Deskripsi');
                formData.append('status', document.getElementById('status').value || 'draft');

                // Add head data if exists
                const headName = document.getElementById('headName').value;
                if (headName) {
                    formData.append('headName', headName);
                    formData.append('headPosition', document.getElementById('headPosition').value);
                    formData.append('headEmail', document.getElementById('headEmail').value);

                    const headPhoto = document.getElementById('headPhoto').files[0];
                    if (headPhoto) {
                        formData.append('headPhoto', headPhoto);
                    }
                }

                // Add division data
                const divisionName = document.querySelector(`[name="divisions[${divisionId}][name]"]`).value;
                if (!divisionName) {
                    throw new Error('Nama divisi harus diisi terlebih dahulu');
                }

                formData.append(`divisions[${divisionId}][name]`, divisionName);
                formData.append(`divisions[${divisionId}][order]`, divisionId);

                // Add member data
                formData.append(`divisions[${divisionId}][members][1][nama]`, nama);
                formData.append(`divisions[${divisionId}][members][1][jabatan]`, jabatan);
                formData.append(`divisions[${divisionId}][members][1][email]`, email);
                formData.append(`divisions[${divisionId}][members][1][order]`, 1);

                // Add photo if exists
                const photoInput = memberDiv.querySelector('input[type="file"]');
                if (photoInput && photoInput.files[0]) {
                    formData.append(`divisions[${divisionId}][members][1][photo]`, photoInput.files);
                }

                console.log('Sending member data:', {
                    divisionId,
                    memberNumber,
                    nama,
                    jabatan,
                    email,
                    divisionName
                });

                const response = await fetch(window.routes['admin.tentang-kami.struktur-organisasi.store'], {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const result = await response.json();

                if (result.success) {
                    statusDiv.innerHTML = '<span class="text-green-600">✓ Tersimpan</span>';
                    showNotification(`Anggota ${nama} berhasil disimpan`, 'success');
                } else {
                    statusDiv.innerHTML = '<span class="text-red-600">✗ Gagal</span>';
                    showNotification(result.message || 'Gagal menyimpan anggota', 'error');
                }
            } catch (error) {
                console.error('Error saving member:', error);
                statusDiv.innerHTML = '<span class="text-red-600">✗ Error</span>';
                showNotification(error.message || 'Terjadi kesalahan saat menyimpan', 'error');
            } finally {
                // Restore button
                button.disabled = false;
                button.innerHTML =
                    '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Simpan';
            }
        }

        // Remove division
        function removeDivision(divisionId) {
            if (confirm('Apakah Anda yakin ingin menghapus divisi ini beserta semua anggotanya?')) {
                const divisionElement = document.querySelector(`[data-division-id="${divisionId}"]`);
                divisionElement.remove();

                // Show empty state if no divisions left
                const container = document.getElementById('divisionsContainer');
                if (container.children.length === 0) {
                    document.getElementById('divisionsEmptyState').style.display = 'block';
                }
                updateTreePreview();
            }
        }

        // Remove member
        function removeMember(button) {
            if (confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
                const memberEntry = button.closest('.staff-entry');
                memberEntry.remove();
                updateTreePreview();
            }
        }

        // Tambahkan function untuk attach event listeners pada input staf
        function attachStaffInputListeners(staffDiv) {
            const inputs = staffDiv.querySelectorAll('input[type="text"], input[type="email"]');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    updateTreePreview();
                    // Trigger auto save untuk staf juga
                    autoSaveStaff(this);
                });

                input.addEventListener('blur', function() {
                    // Auto save saat input kehilangan fokus
                    autoSaveStaff(this);
                });
            });
        }

        // Function auto save untuk staf individual
        function autoSaveStaff(inputElement) {
            // Debounce auto save agar tidak terlalu sering
            clearTimeout(window.staffAutoSaveTimeout);
            window.staffAutoSaveTimeout = setTimeout(() => {
                const staffDiv = inputElement.closest('.staff-entry');
                const divisionDiv = inputElement.closest('.division-entry');

                if (staffDiv && divisionDiv) {
                    const divisionId = divisionDiv.dataset.divisionId;
                    const memberNumber = staffDiv.dataset.memberId;

                    // Cek apakah data sudah lengkap sebelum auto save
                    const nama = staffDiv.querySelector(`input[name*="[nama]"]`)?.value?.trim();
                    const jabatan = staffDiv.querySelector(`input[name*="[jabatan]"]`)?.value?.trim();

                    if (nama && jabatan) {
                        console.log('Auto saving staff:', nama);
                        saveMember(divisionId, memberNumber);
                    }
                }
            }, 2000); // Auto save 2 detik setelah user berhenti mengetik
        }

        function addMember(divisionId, data = null, memberIndex = null) {
            const membersList = document.getElementById(`membersList${divisionId}`);
            const currentMemberCount = membersList.children.length + 1;
            const memberNumber = memberIndex || currentMemberCount;

            const memberHtml = `
        <div class="staff-entry bg-white p-4 rounded-lg border border-gray-200" data-member-id="${memberNumber}">
            <!-- Photo Preview Container -->
            <div class="flex justify-center mb-3">
                <div class="relative">
                    <img id="photoPreview_${divisionId}_${memberNumber}" 
                         class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 hidden" 
                         alt="Preview">
                    <div id="photoPlaceholder_${divisionId}_${memberNumber}" 
                         class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][nama]" required
                           value="${data?.nama || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][jabatan]" required
                           value="${data?.jabatan || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="divisions[${divisionId}][members][${memberNumber}][email]"
                           value="${data?.email || ''}"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" 
                               id="photoInput_${divisionId}_${memberNumber}"
                               name="divisions[${divisionId}][members][${memberNumber}][photo]" 
                               accept="image/*" 
                               class="text-sm w-full">
                    </div>
                    <div id="memberSaveStatus${divisionId}_${memberNumber}" class="text-xs">
                        <!-- Save status will appear here -->
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    <button type="button" onclick="saveMember(${divisionId}, ${memberNumber})" 
                            class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" onclick="removeMember(this)" 
                            class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    `;

            membersList.insertAdjacentHTML('beforeend', memberHtml);

            // ✅ PENTING: Attach photo preview listener pada input yang baru ditambahkan
            const photoInput = document.getElementById(`photoInput_${divisionId}_${memberNumber}`);
            const photoPreview = document.getElementById(`photoPreview_${divisionId}_${memberNumber}`);
            const photoPlaceholder = document.getElementById(`photoPlaceholder_${divisionId}_${memberNumber}`);

            if (photoInput && photoPreview && photoPlaceholder) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            photoPreview.src = event.target.result;
                            photoPreview.classList.remove('hidden');
                            photoPlaceholder.classList.add('hidden');
                            updateTreePreview(); // Update preview tree
                        };
                        reader.readAsDataURL(file);
                    } else {
                        photoPreview.classList.add('hidden');
                        photoPlaceholder.classList.remove('hidden');
                        photoPreview.src = '';
                        updateTreePreview();
                    }
                });
            }

            // Attach event listeners untuk input text
            attachStaffInputListeners(membersList.lastElementChild);

            updateTreePreview();
        }

        // Alternatif: Gunakan Event Delegation untuk semua input dalam divisions container
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk semua input dalam divisions container
            const divisionsContainer = document.getElementById('divisionsContainer');

            if (divisionsContainer) {
                divisionsContainer.addEventListener('input', function(event) {
                    if (event.target.matches('input[type="text"], input[type="email"]')) {
                        updateTreePreview();

                        // Auto save untuk staf
                        if (event.target.name.includes('members')) {
                            autoSaveStaff(event.target);
                        }
                    }
                });

                // Event untuk divisi name juga
                divisionsContainer.addEventListener('input', function(event) {
                    if (event.target.name.includes('divisions') && event.target.name.includes('[name]')) {
                        // Auto save divisi name
                        clearTimeout(window.divisionAutoSaveTimeout);
                        window.divisionAutoSaveTimeout = setTimeout(() => {
                            const divisionDiv = event.target.closest('.division-entry');
                            if (divisionDiv) {
                                const divisionId = divisionDiv.dataset.divisionId;
                                console.log('Auto saving division name');
                                // Bisa tambahkan auto save divisi di sini jika diperlukan
                            }
                        }, 2000);
                    }
                });
            }

            // Attach listeners untuk input kepala (yang sudah ada)
            const inputs = ['orgName', 'orgDescription', 'headName', 'headPosition', 'headEmail'];
            inputs.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', function() {
                        updateTreePreview();

                        // Auto save untuk kepala
                        if (this.id.startsWith('head')) {
                            clearTimeout(window.headAutoSaveTimeout);
                            window.headAutoSaveTimeout = setTimeout(() => {
                                console.log('Auto saving head data');
                                // Auto save kepala bisa ditambahkan di sini
                                autoSaveHead();
                            }, 2000);
                        }
                    });
                }
            });

            // Load existing divisions with proper event listeners
            @if ($organization && isset($organization['divisions']) && !empty($organization['divisions']))
                @foreach ($organization['divisions'] as $division)
                    addDivisionEntry(@json($division));
                @endforeach

                // Attach listeners untuk existing staff
                setTimeout(() => {
                    document.querySelectorAll('.staff-entry').forEach(staffDiv => {
                        attachStaffInputListeners(staffDiv);
                    });
                }, 100);
            @endif
        });

        // Function auto save untuk kepala
        function autoSaveHead() {
            const headName = document.getElementById('headName').value;
            const headPosition = document.getElementById('headPosition').value;

            if (headName && headPosition) {
                console.log('Auto saving head:', headName);
                // Implementasi auto save kepala
                // saveHead(); // jika ada function khusus
            }
        }

        // Save organization data (keep existing function)
        async function saveOrganization() {
            const form = document.getElementById('organizationForm');
            const formData = new FormData(form);

            // Show loading state
            const saveButtons = document.querySelectorAll('button[onclick="saveOrganization()"]');
            saveButtons.forEach(button => {
                button.disabled = true;
                button.innerHTML =
                    '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menyimpan...';
            });

            try {
                const response = await fetch(window.routes['admin.tentang-kami.struktur-organisasi.store'], {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Update last saved time
                    document.getElementById('lastSavedTime').textContent = new Date().toLocaleString('id-ID');

                    // Show success message
                    showNotification('Semua data berhasil disimpan! Total ' + (result.saved_records || '0') +
                        ' record tersimpan.', 'success');

                    // Update all member save status
                    document.querySelectorAll('[id^="memberSaveStatus"]').forEach(statusDiv => {
                        statusDiv.innerHTML = '<span class="text-green-600">✓ Tersimpan</span>';
                    });
                } else {
                    showNotification(result.message || 'Terjadi kesalahan saat menyimpan', 'error');
                }
            } catch (error) {
                console.error('Error saving data:', error);
                showNotification('Terjadi kesalahan saat menyimpan data', 'error');
            } finally {
                // Restore button state
                saveButtons.forEach(button => {
                    button.disabled = false;
                    button.innerHTML =
                        '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Simpan';
                });
            }
        }

        // Show notification (keep existing)
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-md ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
            notification.innerHTML = `
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    ${type === 'success' 
                        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                    }
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">${message}</p>
                </div>
                <div class="ml-4 pl-4 border-l border-white/20">
                    <button class="text-white hover:text-gray-200" onclick="this.closest('.fixed').remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        // Preview functions (keep existing)
        function previewCarousel() {
            const data = treeRenderer.collectFormData();
            document.getElementById('carouselPreviewModal').classList.remove('hidden');
        }

        function previewOrgChart() {
            const data = treeRenderer.collectFormData();
            document.getElementById('orgChartPreviewModal').classList.remove('hidden');
        }

        function closeCarouselPreview() {
            document.getElementById('carouselPreviewModal').classList.add('hidden');
        }

        function closeOrgChartPreview() {
            document.getElementById('orgChartPreviewModal').classList.add('hidden');
        }

        // DON'T auto-load existing divisions to prevent duplication
        // Only load if specifically needed for editing
        @if ($organization && isset($organization['divisions']) && !empty($organization['divisions']))
            document.addEventListener('DOMContentLoaded', function() {
                // Only load if we're editing existing data
                @foreach ($organization['divisions'] as $division)
                    addDivisionEntry(@json($division));
                @endforeach
            });
        @endif
    </script>

    <style>
        .text-primary {
            color: #4f46e5;
        }

        #organizationTreeContainer {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
    </style>
</x-admin.layouts>
