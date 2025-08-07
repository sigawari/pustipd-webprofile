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

        /* Table Styles */
        .ketetapan-table {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(6, 39, 73, 0.08);
            border: 1px solid rgba(6, 39, 73, 0.1);
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
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #0f3460 0%, #1a4a73 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 39, 73, 0.3);
        }

        .not-available {
            color: #9ca3af;
            font-style: italic;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            .ketetapan-table {
                font-size: 0.875rem;
            }

            .table-header th {
                padding: 0.75rem 0.5rem;
            }

            .table-row td {
                padding: 0.75rem 0.5rem;
            }

            .download-btn {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }
        }
    </style>

    <section id="public-info" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    {{ $title }}
                </h2>
                <h3 class="text-lg text-secondary pt-4">
                    Ketetapan terkait PUSTIPD yang bisa diunduh
                </h3>
            </div>

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

            <!-- Tabel Ketetapan -->
            <div class="max-w-6xl mx-auto">
                <div class="ketetapan-table mb-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- Table Header -->
                            <thead class="table-header">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider w-16">
                                        No.
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                        Nama Ketetapan
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider hidden md:table-cell">
                                        Deskripsi Singkat
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider w-32">
                                        Tahun Terbit
                                    </th>
                                    <th
                                        class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider w-32">
                                        Dokumen
                                    </th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-200">
                                @forelse($ketetapans as $index => $ketetapan)
                                    <tr class="table-row">
                                        <!-- Nomor -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ ($ketetapans->currentPage() - 1) * $ketetapans->perPage() + $index + 1 }}.
                                        </td>

                                        <!-- Nama -->
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="font-semibold text-secondary mb-1">
                                                {{ $ketetapan->title }}
                                            </div>
                                            <!-- Kategori & Authority -->
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                @if ($ketetapan->category)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $ketetapan->category }}
                                                    </span>
                                                @endif
                                                @if ($ketetapan->authority)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $ketetapan->authority }}
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- Deskripsi di mobile -->
                                            <div class="text-xs text-gray-600 md:hidden mt-2">
                                                {{ Str::limit($ketetapan->description, 80) }}
                                            </div>
                                        </td>

                                        <!-- Deskripsi (hidden di mobile) -->
                                        <td class="px-6 py-4 text-sm text-gray-600 hidden md:table-cell">
                                            <div class="max-w-xs">
                                                {{ Str::limit($ketetapan->description, 120) }}
                                            </div>
                                            @if ($ketetapan->file_size)
                                                <div class="text-xs text-gray-400 mt-1">
                                                    Ukuran: {{ $ketetapan->formatted_file_size }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Tahun Terbit -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-semibold">
                                                @if ($ketetapan->effective_date)
                                                    {{ \Carbon\Carbon::parse($ketetapan->effective_date)->format('Y') }}
                                                @elseif($ketetapan->created_at)
                                                    {{ \Carbon\Carbon::parse($ketetapan->created_at)->format('Y') }}
                                                @else
                                                    <span class="not-available">-</span>
                                                @endif
                                            </div>
                                            @if ($ketetapan->effective_date)
                                                <div class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($ketetapan->effective_date)->format('d M Y') }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Download Button -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($ketetapan->file_path && file_exists(storage_path('app/public/' . $ketetapan->file_path)))
                                                <a href="{{ asset('storage/' . $ketetapan->file_path) }}"
                                                    class="download-btn" target="_blank"
                                                    download="{{ $ketetapan->title }}.{{ pathinfo($ketetapan->file_path, PATHINFO_EXTENSION) }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="hidden sm:inline">Download</span>
                                                    <span class="sm:hidden">PDF</span>
                                                </a>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-400 text-xs font-medium cursor-not-allowed">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                    </svg>
                                                    <span class="hidden sm:inline">Tidak Tersedia</span>
                                                    <span class="sm:hidden">N/A</span>
                                                </span>
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
                                                    <p class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan
                                                    </p>
                                                    <p class="text-gray-500 mb-4">Tidak ada ketetapan yang sesuai dengan
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
                                                        Lihat Semua Ketetapan
                                                    </a>
                                                @else
                                                    <!-- No data at all -->
                                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="text-lg font-medium text-gray-900 mb-2">Belum ada
                                                        ketetapan tersedia</p>
                                                    <p class="text-gray-500">Ketetapan akan segera ditambahkan oleh
                                                        admin</p>
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
                @if ($ketetapans->hasPages())
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <!-- Info Pagination -->
                        <div class="text-sm text-secondary">
                            Menampilkan {{ $ketetapans->firstItem() ?? 0 }} sampai {{ $ketetapans->lastItem() ?? 0 }}
                            dari {{ $ketetapans->total() ?? 0 }} ketetapan
                        </div>

                        <!-- Pagination Links -->
                        <div class="flex justify-center items-center gap-2">
                            <!-- Previous Button -->
                            @if ($ketetapans->onFirstPage())
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $ketetapans->appends(request()->all())->previousPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-600 hover:text-white border border-gray-200 hover:border-blue-600 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($ketetapans->appends(request()->all())->getUrlRange(1, $ketetapans->lastPage()) as $page => $url)
                                @if ($page == $ketetapans->currentPage())
                                    <span
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-600 text-white font-semibold shadow-sm">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-600 hover:text-white border border-gray-200 hover:border-blue-600 transition-all duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if ($ketetapans->hasMorePages())
                                <a href="{{ $ketetapans->appends(request()->all())->nextPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-600 hover:text-white border border-gray-200 hover:border-blue-600 transition-all duration-200">
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
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-public.layouts>
