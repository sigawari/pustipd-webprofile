<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        .underline-animate::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 0;
            height: 4px;
            width: 0;
            background-color: #062749;
            transition: width 0.4s ease;
        }

        .group:hover .underline-animate::after {
            width: 100%;
        }

        /* Custom table styles */
        .panduan-table {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .table-header {
            background: linear-gradient(135deg, #062749 0%, #0f3460 100%);
            color: white;
        }

        .table-row:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .download-btn {
            background: linear-gradient(135deg, #062749 0%, #0f3460 100%);
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px -1px rgb(6 39 73 / 0.3);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-published {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .panduan-table {
                font-size: 0.875rem;
            }

            .table-header th {
                padding: 0.75rem 0.5rem;
            }

            .table-row td {
                padding: 0.75rem 0.5rem;
            }

            .status-badge {
                font-size: 0.625rem;
                padding: 0.125rem 0.5rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="py-20 bg-primary" id="panduan">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 m-6">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary m-4 relative inline-block underline-animate">
                    {{ $title }}
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Kumpulan panduan yang terdapat di PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Form -->
            <form action="{{ request()->url() }}" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari {{ strtolower($title) }} di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
                              text-secondary placeholder-gray-400
                              bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
                              focus:outline-none" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-secondary">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                    </svg>
                </button>
            </form>

            <!-- Tabel Panduan -->
            <div class="panduan-table mb-12 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <!-- Table Header -->
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider w-16">
                                    No.
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Judul Panduan
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider hidden md:table-cell">
                                    Deskripsi
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider hidden lg:table-cell w-32">
                                    Kategori
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider w-32">
                                    Download
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="divide-y divide-gray-200">
                            @forelse($panduans as $index => $panduan)
                                <tr class="table-row">
                                    <!-- Nomor -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ ($panduans->currentPage() - 1) * $panduans->perPage() + $index + 1 }}.
                                    </td>

                                    <!-- Judul -->
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-semibold text-secondary mb-1">
                                            {{ $panduan->title }}
                                        </div>
                                        <div class="text-xs text-gray-500 mb-2">
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($panduan->created_at)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <!-- Deskripsi di mobile -->
                                        <div class="text-xs text-gray-600 md:hidden mt-1">
                                            {{ Str::limit($panduan->description, 80) }}
                                        </div>
                                        <!-- Kategori di mobile -->
                                        @if ($panduan->category)
                                            <div class="lg:hidden mt-2">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $panduan->category }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Deskripsi (hidden di mobile) -->
                                    <td class="px-6 py-4 text-sm text-gray-600 hidden md:table-cell">
                                        <div class="max-w-xs">
                                            {{ Str::limit($panduan->description, 120) }}
                                        </div>
                                        @if ($panduan->file_size)
                                            <div class="text-xs text-gray-400 mt-1">
                                                Ukuran: {{ $panduan->formatted_file_size }}
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Kategori (hidden di mobile & tablet) -->
                                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        @if ($panduan->category)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $panduan->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>

                                    <!-- Download Button -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                            <a href="{{ asset('storage/' . $panduan->file_path) }}"
                                                class="download-btn inline-flex items-center px-3 py-2 rounded-lg text-white text-xs font-medium hover:shadow-lg"
                                                target="_blank"
                                                download="{{ $panduan->title }}.{{ pathinfo($panduan->file_path, PATHINFO_EXTENSION) }}">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="hidden sm:inline">Download</span>
                                                <span class="sm:hidden">PDF</span>
                                            </a>
                                        @else
                                            <button
                                                class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-300 text-gray-500 text-xs font-medium cursor-not-allowed"
                                                disabled title="File tidak tersedia">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                </svg>
                                                <span class="hidden sm:inline">Tidak Tersedia</span>
                                                <span class="sm:hidden">N/A</span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <!-- Empty State -->
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            @if (request('search'))
                                                <!-- Empty search result -->
                                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                                                </svg>
                                                <p class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan</p>
                                                <p class="text-gray-500 mb-4">Tidak ada panduan yang sesuai dengan
                                                    pencarian "{{ request('search') }}"</p>
                                                <a href="{{ request()->url() }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                        </path>
                                                    </svg>
                                                    Lihat Semua Panduan
                                                </a>
                                            @else
                                                <!-- No data at all -->
                                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-lg font-medium text-gray-900 mb-2">Belum ada panduan
                                                    tersedia</p>
                                                <p class="text-gray-500">Panduan akan segera ditambahkan oleh admin</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($panduans->hasPages())
                <div class="flex justify-center items-center gap-2">
                    <!-- Previous Button -->
                    @if ($panduans->onFirstPage())
                        <span
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $panduans->appends(request()->all())->previousPageUrl() }}"
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    <!-- Page Numbers -->
                    @foreach ($panduans->appends(request()->all())->getUrlRange(1, $panduans->lastPage()) as $page => $url)
                        @if ($page == $panduans->currentPage())
                            <span
                                class="flex items-center justify-center w-10 h-10 rounded-lg bg-custom-blue text-white font-semibold shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    <!-- Next Button -->
                    @if ($panduans->hasMorePages())
                        <a href="{{ $panduans->appends(request()->all())->nextPageUrl() }}"
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            </a>
                    @endif
                </div>
            @endif

            <!-- Info Section (Optional) -->
            @if ($panduans->count() > 0)
                <div class="text-center mt-6 text-sm text-secondary">
                    Menampilkan {{ $panduans->firstItem() ?? 0 }} sampai {{ $panduans->lastItem() ?? 0 }} dari
                    {{ $panduans->total() ?? 0 }} panduan
                </div>
            @endif
        </div>
    </section>
</x-public.layouts>
