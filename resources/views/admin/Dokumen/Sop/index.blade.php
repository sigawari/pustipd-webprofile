<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Dokumen PUSTIPD')
    @section('page-description', 'Kelola konten SOP UIN Raden Fatah Palembang')
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
                <p class="text-gray-600 mt-1 text-sm">Kelola dokumen {{ strtolower($title) }} yang akan ditampilkan di
                    website publik</p>
            </div>
            <button onclick="openAddModal()"
                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah {{ $title }}
            </button>
        </div>

        <script>
            window.bulkActionRoute = "{{ route('admin.dokumen.sop.bulk') }}";
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                window.initBulkActions();
            });
        </script>

        <!-- Bulk Actions Bar -->
        <div id="bulkActionsBar" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-blue-800 font-medium">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                </div>

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
            </div>
        </div>

        <!-- Filter dan Search -->
        <div class="flex flex-col gap-3 mb-4 sm:mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="search-input" value="{{ request('search') }}"
                    data-url="{{ route('admin.dokumen.sop.index') }}" data-target="sopTableBody"
                    placeholder="Cari {{ strtolower($title) }}..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <select id="filter-select" name="filter" data-url="{{ route('admin.dokumen.sop.index') }}"
                    data-target="sopTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>-- Semua Status --
                    </option>
                    <option value="published" {{ request('filter') == 'published' ? 'selected' : '' }}>Published
                    </option>
                    <option value="draft" {{ request('filter') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>

                <select id="perpage-select" name="perPage"
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

        <!-- Table dengan checkbox -->
        <div class="overflow-x-auto -mx-3 sm:mx-0">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <!-- Checkbox -->
                                <th class="px-4 py-3">
                                    <input type="checkbox" id="selectAll"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>

                                <!-- Nomor Urut -->
                                <th
                                    class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                    No.
                                </th>

                                <!-- Judul SOP -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama {{ $title }}
                                </th>

                                <!-- Deskripsi -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>

                                <!-- Tahun Terbit -->
                                <th
                                    class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tahun Terbit
                                </th>

                                <!-- File Info (tipe + size) -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    File
                                </th>

                                <!-- Status -->
                                <th
                                    class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>

                                <!-- Aksi -->
                                <th
                                    class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="sopTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.dokumen.sop.partials.table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4">
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan {{ $sops->firstItem() }} sampai {{ $sops->lastItem() }} dari
                {{ $sops->total() }} {{ strtolower($title) }}
            </div>

            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    @if ($sops->onFirstPage())
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
                        <a href="{{ $sops->appends(request()->all())->previousPageUrl() }}"
                            class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    @foreach ($sops->appends(request()->all())->getUrlRange(1, $sops->lastPage()) as $page => $url)
                        @if ($page == $sops->currentPage())
                            <span
                                class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($sops->hasMorePages())
                        <a href="{{ $sops->appends(request()->all())->nextPageUrl() }}"
                            class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
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
    </div>

    @include('admin.dokumen.sop.create')
    @include('admin.dokumen.sop.update')
    @include('admin.dokumen.sop.delete')
</x-admin.layouts>
