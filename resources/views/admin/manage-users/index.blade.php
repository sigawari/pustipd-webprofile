<x-admin.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('page-title', 'Beranda PUSTIPD')
    @section('page-description', 'Kelola konten Pengguna UIN Raden Fatah Palembang')

    <!-- Content Management Area - PERBAIKAN MOBILE -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">Kelola {{ $title }} yang akan memiliki akses ke website</p>
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

        <!-- Filter dan Search - MOBILE RESPONSIVE -->
        <div class="flex flex-col gap-3 mb-4 sm:mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="search-input" value="{{ request('search') }}"
                    data-url="{{ route('admin.sistem.users.index') }}" data-target="usersTableBody"
                    placeholder="Cari {{ $title }}..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <select id="filter-select" name="filter" data-url="{{ route('admin.sistem.users.index') }}"
                    data-target="usersTableBody"
                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>-- Semua Role --</option>
                    <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user_public" {{ request('filter') == 'user_public' ? 'selected' : '' }}>User
                    </option>
                </select>

                <select id="perpage-select" name="perPage" data-url="{{ route('admin.sistem.users.index') }}"
                    data-target="usersTableBody"
                    class="flex-1 sm:flex-none px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 {{ $title }} per
                        halaman
                    </option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 {{ $title }} per
                        halaman
                    </option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 {{ $title }} per
                        halaman
                    </option>
                    <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>
                        -- Semua {{ $title }} --
                    </option>
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
                                    No.
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.manage-users.partials.table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4">
            <!-- Info jumlah data -->
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }}
                {{ strtolower($title) }}
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    <!-- Tombol Sebelumnya -->
                    @if ($users->onFirstPage())
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
                        <a href="{{ $users->previousPageUrl() }}"
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
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
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
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}"
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
    </div>
    @include('admin.manage-users.create')
    @include('admin.manage-users.update')
    @include('admin.manage-users.delete')
</x-admin.layouts>
