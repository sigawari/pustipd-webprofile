<!-- resources/views/admin/manage-content/about/profil.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Struktur Organisasi PUSTIPD')
    @section('page-description', 'Kelola Struktur Organisasi PUSTIPD')

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
                                    placeholder="Nama Kepala Organisasi">
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
</x-admin.layouts>
