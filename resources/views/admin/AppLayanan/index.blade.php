<!-- resources/views/admin/manage-content/applayanan/index.blade.php -->
<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Aplikasi dan Layanan PUSTIPD')
    @section('page-description', 'Kelola konten aplikasi dan layanan')
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
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Aplikasi dan Layanan</span>
            </div>
        </li>
    @endsection

    <!-- Content Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">Kelola {{ $title }} yang akan ditampilkan di halaman
                    layanan</p>
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
                <a href="{{ route('admin.app-layanan.export', [
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

        <!-- CSRF Token dan Bulk Route -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            window.bulkActionRoute = "{{ route('admin.app-layanan.bulk') }}";
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.initBulkActions();
                const categorySelect = document.getElementById('category-select');

                if (categorySelect) {
                    categorySelect.addEventListener('change', function() {
                        const url = this.dataset.url;
                        const target = this.dataset.target;
                        const category = this.value;

                        // Ambil parameter yang sudah ada
                        const urlParams = new URLSearchParams(window.location.search);

                        // Update parameter category
                        if (category) {
                            urlParams.set('category', category);
                        } else {
                            urlParams.delete('category');
                        }

                        // Buat URL baru dengan semua parameter
                        const newUrl = url + '?' + urlParams.toString();

                        // AJAX request
                        fetch(newUrl, {
                                method: 'GET',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.text())
                            .then(html => {
                                // Update table body
                                const targetElement = document.getElementById(target);
                                if (targetElement) {
                                    targetElement.innerHTML = html;
                                }

                                // Update URL tanpa reload
                                window.history.pushState({}, '', newUrl);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                }
            });
        </script>

        <!-- Bulk Actions Bar -->
        <div id="bulkActionsBar" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium text-blue-800">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="bulkAction('published')"
                        class="px-3 py-1 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        📢 Publish
                    </button>
                    <button onclick="bulkAction('draft')"
                        class="px-3 py-1 bg-yellow-600 text-white text-sm rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        📝 Draft
                    </button>
                    <button onclick="bulkAction('permanent_delete')"
                        class="px-3 py-1 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        🗑️ Hapus
                    </button>
                </div>
            </div>
        </div>


        <!-- ADOPSI: Filter dan Search dengan AJAX -->
        <div class="flex flex-col gap-3 mb-4 sm:mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="search-input" value="{{ request('search') }}"
                    data-url="{{ route('admin.app-layanan.index') }}" data-target="appLayananTableBody"
                    placeholder="Cari {{ $title }}..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <select id="category-select" name="category" data-url="{{ route('admin.app-layanan.index') }}"
                    data-target="appLayananTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="" {{ request('category') == '' ? 'selected' : '' }}>-- Semua Kategori --
                    </option>
                    <option value="akademik" {{ request('category') == 'akademik' ? 'selected' : '' }}>Akademik
                    </option>
                    <option value="pegawai" {{ request('category') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    <option value="pembelajaran" {{ request('category') == 'pembelajaran' ? 'selected' : '' }}>
                        Pembelajaran</option>
                    <option value="administrasi" {{ request('category') == 'administrasi' ? 'selected' : '' }}>
                        Administrasi</option>
                </select>

                <select id="filter-select" name="filter" data-url="{{ route('admin.app-layanan.index') }}"
                    data-target="appLayananTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>-- Semua Status --
                    </option>
                    <option value="published" {{ request('filter') == 'published' ? 'selected' : '' }}>Published
                    </option>
                    <option value="draft" {{ request('filter') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>

                <select id="perpage-select" name="perPage" data-url="{{ route('admin.app-layanan.index') }}"
                    data-target="appLayananTableBody"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>-- Semua
                        {{ $title }} --</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 {{ $title }}
                        per halaman</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 {{ $title }}
                        per halaman</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 {{ $title }}
                        per halaman</option>
                </select>
            </div>
        </div>

        <!-- ADOPSI: Table dengan checkbox dan AJAX loading -->
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
                                    No.
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Aplikasi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Link Akses
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="appLayananTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.AppLayanan.partials.table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination yang lebih sederhana dan responsif -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4"
            id="pagination-container">
            <div class="text-sm text-gray-500 text-center sm:text-left" id="pagination-info">
                @php
                    $hasFilter =
                        request()->hasAny(['search', 'status', 'category']) &&
                        (request('search') ||
                            (request('status') && request('status') !== 'all') ||
                            (request('category') && request('category') !== ''));
                @endphp

                @if ($appLayanans->total() > 0)
                    @if (request('perPage') === 'all')
                        Menampilkan semua {{ number_format($appLayanans->total()) }} {{ strtolower($title) }}
                    @else
                        Menampilkan
                        {{ number_format($appLayanans->firstItem() ?? 1) }}
                        sampai
                        {{ number_format($appLayanans->lastItem() ?? $appLayanans->total()) }}
                        dari {{ number_format($appLayanans->total()) }} {{ strtolower($title) }}

                        {{-- Debug info --}}
                        <span class="text-gray-400 text-xs">
                            ({{ $appLayanans->perPage() }} per halaman)
                        </span>
                    @endif

                    @if ($hasFilter)
                        <span class="text-blue-600 font-medium">(difilter)</span>
                    @endif
                @else
                    Tidak ada {{ strtolower($title) }} yang ditemukan
                    @if ($hasFilter)
                        <span class="text-orange-600">dengan filter yang dipilih</span>
                    @endif
                @endif
            </div>

            <!-- Tombol Pagination -->
            @if ($appLayanans->hasPages())
                <div class="flex justify-center sm:justify-end" id="pagination-links">
                    <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                        <!-- Tombol Sebelumnya -->
                        @if ($appLayanans->onFirstPage())
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
                            <a href="{{ $appLayanans->previousPageUrl() }}"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1 pagination-link">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="hidden sm:inline">Sebelumnya</span>
                            </a>
                        @endif

                        @if ($appLayanans->lastPage() > 1)
                            @php
                                $start = max(1, $appLayanans->currentPage() - 2);
                                $end = min($appLayanans->lastPage(), $appLayanans->currentPage() + 2);
                            @endphp

                            {{-- First page --}}
                            @if ($start > 1)
                                <a href="{{ $appLayanans->url(1) }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 pagination-link">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-3 py-2 text-sm font-medium text-gray-500">...</span>
                                @endif
                            @endif

                            {{-- Page numbers --}}
                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $appLayanans->currentPage())
                                    <span
                                        class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $appLayanans->url($page) }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 pagination-link">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            {{-- Last page --}}
                            @if ($end < $appLayanans->lastPage())
                                @if ($end < $appLayanans->lastPage() - 1)
                                    <span class="px-3 py-2 text-sm font-medium text-gray-500">...</span>
                                @endif
                                <a href="{{ $appLayanans->url($appLayanans->lastPage()) }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 pagination-link">
                                    {{ $appLayanans->lastPage() }}
                                </a>
                            @endif
                        @endif

                        <!-- Tombol Selanjutnya -->
                        @if ($appLayanans->hasMorePages())
                            <a href="{{ $appLayanans->nextPageUrl() }}"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1 pagination-link">
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
            @endif
        </div>

    </div>

    <!-- ADOPSI: Modal untuk Tambah, Edit, Hapus -->
    @include('admin.AppLayanan.create')
    @include('admin.AppLayanan.update')
    @include('admin.AppLayanan.delete')
</x-admin.layouts>
