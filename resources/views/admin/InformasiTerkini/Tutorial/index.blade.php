<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Tutorial PUSTIPD')
    @section('page-description', content: 'Kelola konten tutorial')
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
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">{{ $title }}</span>
            </div>
        </li>
    @endsection

    <!-- Content Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">Kelola tutorial berdasarkan kategori yang akan ditampilkan di
                    halaman tutorial</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button onclick="openAddModal()"
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah {{ $title }}
                </button>
                <!-- Button Export -->
                <a href="{{ route('admin.informasi-terkini.kelola-tutorial.export', [
                    'filter' => request()->get('filter', 'all'),
                    'search' => request()->get('search')
                ]) }}"
                class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <script>
            window.bulkActionRoute = "{{ route('admin.informasi-terkini.kelola-tutorial.bulk') }}";
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                window.initBulkActions();
            });
        </script>

        <!-- Actions untuk tutorial (tanpa archived karena status cuma draft & published) -->
        <div class="flex flex-col sm:flex-row gap-2" id="bulkActionsBar">
            <div id="defaultActions">
                <button onclick="bulkAction('published')"
                    class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
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
            </div>
        </div>

        <!-- Filter dan Search - Updated dengan kategori PUSTIPD -->
        <div class="flex flex-col gap-3 mb-4 sm:mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="searchInput" placeholder="Cari {{ $title }}..."
                    data-url="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}"
                    data-target="tutorialTableBody"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <!-- Updated kategori sesuai dengan model -->
                <select id="categoryFilter"
                    data-url="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}"
                    data-target="tutorialTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="">Semua Kategori</option>
                    <option value="sistem_informasi_akademik">Sistem Informasi Akademik</option>
                    <option value="e_learning">E-Learning & Pembelajaran Daring</option>
                    <option value="layanan_digital_mahasiswa">Layanan Digital Mahasiswa</option>
                    <option value="pengelolaan_data_akun">Pengelolaan Data & Akun</option>
                    <option value="jaringan_konektivitas">Jaringan & Konektivitas</option>
                    <option value="software_aplikasi">Software & Aplikasi</option>
                    <option value="penelitian_akademik">Penelitian & Akademik</option>
                    <option value="layanan_publik">Layanan Publik</option>
                </select>
                <select id="statusFilter"
                    data-url="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}"
                    data-target="tutorialTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <!-- NEW: Featured filter -->
                <select id="featuredFilter"
                    data-url="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}"
                    data-target="tutorialTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="">Semua Tutorial</option>
                    <option value="1">Tutorial Featured</option>
                    <option value="0">Tutorial Biasa</option>
                </select>
                <select id="perPage"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                </select>
            </div>
        </div>

        <!-- Table dengan kolom yang disesuaikan untuk tutorial -->
        <div class="overflow-x-auto -mx-3 sm:mx-0">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" style="min-width: 1200px;">
                        <!-- THEAD yang diperbaiki sesuai dengan table_body -->
                        <thead class="bg-gray-50">
                            <tr>
                                <!-- 1. Checkbox -->
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <!-- 2. No -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <!-- 3. Kategori -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <!-- 4. Title -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul {{ $title }}
                                </th>
                                <!-- 5. Content Preview -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Preview Konten
                                </th>
                                <!-- 6. Content Structure (NEW) -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Struktur
                                </th>
                                <!-- 7. View Count (NEW) -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Views
                                    </div>
                                </th>
                                <!-- 8. Status -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <!-- 9. Date -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <!-- 10. Actions -->
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody id="tutorialTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.InformasiTerkini.Tutorial.partials.table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4">
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan {{ $kelolaTutorials->firstItem() }} sampai {{ $kelolaTutorials->lastItem() }} dari
                {{ $kelolaTutorials->total() }}
                {{ strtolower($title) }}
            </div>

            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    @if ($kelolaTutorials->onFirstPage())
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $kelolaTutorials->previousPageUrl() }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    @foreach ($kelolaTutorials->getUrlRange(1, $kelolaTutorials->lastPage()) as $page => $url)
                        @if ($page == $kelolaTutorials->currentPage())
                            <span
                                class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <span
                                class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                {{ $page }}
                            </span>
                        @endif
                    @endforeach

                    @if ($kelolaTutorials->hasMorePages())
                        <a href="{{ $kelolaTutorials->nextPageUrl() }}"
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

        @include('admin.InformasiTerkini.Tutorial.create')
        @include('admin.InformasiTerkini.Tutorial.update')
        @include('admin.InformasiTerkini.Tutorial.delete')
    </div>

    <!-- Additional JavaScript for filters -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const featuredFilter = document.getElementById('featuredFilter');
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');
            const perPageSelect = document.getElementById('perPage');
            const searchInput = document.getElementById('searchInput');

            function fetchFilteredTutorials() {
                const params = new URLSearchParams();
                if (featuredFilter.value) params.append('featured', featuredFilter.value);
                if (categoryFilter.value) params.append('category', categoryFilter.value);
                if (statusFilter.value) params.append('filter', statusFilter.value);
                if (perPageSelect.value) params.append('perPage', perPageSelect.value);
                if (searchInput.value.trim()) params.append('search', searchInput.value.trim());

                fetch(`${window.location.pathname}?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tutorialTableBody').innerHTML = html;
                    })
                    .catch(err => console.error(err));
            }

            featuredFilter.addEventListener('change', fetchFilteredTutorials);
            categoryFilter.addEventListener('change', fetchFilteredTutorials);
            statusFilter.addEventListener('change', fetchFilteredTutorials);
            perPageSelect.addEventListener('change', fetchFilteredTutorials);
            searchInput.addEventListener('input', () => {
                clearTimeout(window.searchTimeout);
                window.searchTimeout = setTimeout(fetchFilteredTutorials, 500);
            });
        });
    </script>
</x-admin.layouts>
