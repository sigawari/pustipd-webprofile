<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="public-info" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    {{ $title }}
                </h2>
                <h3 class="text-lg text-secondary pt-4">
                    {{ $title }} terkait PUSTIPD yang bisa diunduh
                </h3>
                @if (isset($totalDownloadableFiles))
                    <p class="text-sm text-secondary/80 mt-2">
                        Total {{ $totalDownloadableFiles }} dokumen tersedia untuk diunduh
                    </p>
                @endif
            </div>

            <!-- Search dan Bulk -->
            <div class="max-w-6xl mx-auto mb-8">
                <div class="bg-white rounded-xl p-4 lg:p-6 border border-gray-200 shadow-lg">
                    <div class="flex flex-col space-y-4 lg:space-y-0 lg:flex-row lg:items-center lg:justify-between">
                        <!-- Search Form -->
                        <div class="flex-1 max-w-md">
                            <form action="{{ request()->url() }}" method="GET" class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari {{ strtolower($title) }} di sini...."
                                    class="w-full rounded-lg pl-12 pr-4 py-3 text-gray-900 placeholder-gray-500
                                          bg-gray-50 border border-gray-300 shadow-sm 
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                          transition-all duration-200" />
                                <button type="submit"
                                    class="absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <!-- Info Count -->
                            <div class="text-sm text-gray-600 font-medium">
                                <span id="info-count">{{ $panduans->total() }} dokumen tersedia</span>
                            </div>

                            <!-- Select All Button -->
                            <button onclick="toggleSelectAll()" id="select-all-btn"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg 
                                       hover:bg-blue-200 border border-blue-300 hover:border-blue-400
                                       transition-all duration-200 text-sm font-medium min-w-[120px]">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                <span id="select-text">Pilih Semua</span>
                            </button>

                            <!-- Bulk Download Button -->
                            <button onclick="bulkDownloadSelected()" id="bulk-download-btn"
                                class="hidden inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg 
                                       hover:bg-green-700 border border-green-500 hover:border-green-600
                                       transition-all duration-200 text-sm font-medium shadow-lg min-w-[160px]">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download (<span id="selected-count">0</span>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Table Container -->
            <div class="max-w-6xl mx-auto">
                <!-- Desktop Table -->
                <div class="hidden lg:block bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- Table Header -->
                            <thead>
                                <tr class="bg-secondary border-b border-blue-600">
                                    <!-- ✅ FIXED: Header Checkbox with Proper Event Handler -->
                                    <th class="px-4 py-4 text-center w-12">
                                        <input type="checkbox" id="header-checkbox"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                            onchange="toggleAllCheckboxes(this)" title="Pilih/Batal Semua">
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider w-16">
                                        No.
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                        Nama panduan
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                    <th
                                        class="px-6 py-4 text-center text-sm font-semibold text-white uppercase tracking-wider w-32">
                                        Tahun
                                    </th>
                                    <th
                                        class="px-6 py-4 text-center text-sm font-semibold text-white uppercase tracking-wider w-32">
                                        Download
                                    </th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($panduans as $index => $panduan)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <!-- ✅ FIXED: Body Checkbox with Proper Class and Event -->
                                        <td class="px-4 py-4 text-center">
                                            @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                                <input type="checkbox"
                                                    class="file-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                                    value="{{ $panduan->id }}" data-id="{{ $panduan->id }}"
                                                    onchange="updateBulkDownloadButton()">
                                            @else
                                                <span class="w-4 h-4 inline-block"></span>
                                            @endif
                                        </td>

                                        <!-- Number -->
                                        <td class="px-6 py-4 text-sm font-medium text-secondary">
                                            {{ ($panduans->currentPage() - 1) * $panduans->perPage() + $index + 1 }}.
                                        </td>

                                        <!-- Title -->
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-secondary mb-1 leading-tight">
                                                {{ $panduan->title }}
                                            </div>
                                            @if ($panduan->formatted_file_size)
                                                <div
                                                    class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    {{ $panduan->formatted_file_size }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Description -->
                                        <td class="px-6 py-4 text-sm text-secondary leading-relaxed">
                                            <div class="max-w-sm">
                                                {{ Str::limit(strip_tags($panduan->description), 120) }}
                                            </div>
                                        </td>

                                        <!-- Year -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="font-semibold text-secondary">
                                                @if ($panduan->year_published)
                                                    {{ $panduan->year_published }}
                                                @elseif($panduan->created_at)
                                                    {{ $panduan->created_at->format('Y') }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Download Button -->
                                        <td class="px-6 py-4 text-center">
                                            @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                                <a href="{{ route('panduan.download', $panduan->id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg 
                                                           hover:bg-blue-700 transition-colors text-xs font-medium shadow-sm"
                                                    title="Download {{ $panduan->title }}" target="_blank">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    Download
                                                </a>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-2 bg-gray-500 text-gray-300 rounded-lg text-xs font-medium cursor-not-allowed">
                                                    N/A
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty State -->
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center bg-white">
                                            <div class="text-center">
                                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-lg font-medium text-gray-900 mb-2">Belum ada panduan
                                                    tersedia</p>
                                                <p class="text-gray-600">panduan akan segera ditambahkan oleh admin
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Mobile -->
                <div class="lg:hidden">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[640px]">
                                <!-- Mobile Table Header -->
                                <thead>
                                    <tr class="bg-secondary border-b border-blue-600">
                                        <!-- ✅ FIXED: Unique ID untuk mobile header checkbox -->
                                        <th class="px-3 py-3 text-center w-10">
                                            <input type="checkbox" id="mobile-header-checkbox"
                                                class="header-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                                onchange="toggleAllCheckboxes(this)"
                                                style="position: relative; z-index: 10;" title="Pilih/Batal Semua">
                                        </th>
                                        <th
                                            class="px-3 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider w-12">
                                            No.
                                        </th>
                                        <th
                                            class="px-3 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Nama panduan
                                        </th>
                                        <th
                                            class="px-3 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-16">
                                            Tahun
                                        </th>
                                        <th
                                            class="px-3 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-20">
                                            Download
                                        </th>
                                    </tr>
                                </thead>

                                <!-- Mobile Table Body -->
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($panduans as $index => $panduan)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <!-- ✅ FIXED: Checkbox dengan proper styling dan event handling -->
                                            <td class="px-3 py-3 text-center" style="position: relative;">
                                                @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                                    <input type="checkbox"
                                                        class="file-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                                        value="{{ $panduan->id }}" data-id="{{ $panduan->id }}"
                                                        id="mobile-checkbox-{{ $panduan->id }}"
                                                        style="position: relative; z-index: 10; min-width: 16px; min-height: 16px;"
                                                        onchange="updateBulkDownloadButton()"
                                                        onclick="event.stopPropagation();">
                                                @else
                                                    <span class="w-4 h-4 inline-block"></span>
                                                @endif
                                            </td>

                                            <!-- Number -->
                                            <td class="px-3 py-3 text-xs font-medium text-secondary">
                                                {{ ($panduans->currentPage() - 1) * $panduans->perPage() + $index + 1 }}.
                                            </td>

                                            <!-- Title dengan Description dan File Size -->
                                            <td class="px-3 py-3">
                                                <div class="min-w-0">
                                                    <div
                                                        class="font-semibold text-secondary text-sm mb-1 leading-tight">
                                                        {{ Str::limit($panduan->title, 60) }}
                                                    </div>
                                                    <div class="text-xs text-secondary/70 mb-2 leading-relaxed">
                                                        {{ Str::limit(strip_tags($panduan->description), 80) }}
                                                    </div>
                                                    @if ($panduan->formatted_file_size)
                                                        <div
                                                            class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                            {{ $panduan->formatted_file_size }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Year -->
                                            <td class="px-3 py-3 text-center">
                                                <div class="text-xs font-semibold text-secondary">
                                                    @if ($panduan->year_published)
                                                        {{ $panduan->year_published }}
                                                    @elseif($panduan->created_at)
                                                        {{ $panduan->created_at->format('Y') }}
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Download Button -->
                                            <td class="px-3 py-3 text-center">
                                                @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                                    <a href="{{ route('panduan.download', $panduan->id) }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-lg 
                                               hover:bg-blue-700 transition-colors shadow-sm touch-target"
                                                        title="Download {{ $panduan->title }}" target="_blank">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <span
                                                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-400 text-gray-200 rounded-lg cursor-not-allowed">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-3 py-8 text-center bg-white">
                                                <div class="text-center">
                                                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="text-sm font-medium text-gray-900 mb-1">Belum ada panduan
                                                        tersedia</p>
                                                    <p class="text-xs text-gray-600">panduan akan segera ditambahkan
                                                        oleh admin</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($panduans->hasPages())
                    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <!-- Info Pagination -->
                        <div class="text-sm text-secondary">
                            Menampilkan {{ $panduans->firstItem() ?? 0 }} sampai {{ $panduans->lastItem() ?? 0 }}
                            dari {{ $panduans->total() ?? 0 }} panduan
                        </div>

                        <!-- Pagination Links -->
                        <div class="flex justify-center items-center gap-2">
                            <!-- Previous Button -->
                            @if ($panduans->onFirstPage())
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/10 text-secondary/50 border border-white/20 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $panduans->appends(request()->all())->previousPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/20 text-secondary hover:bg-white hover:text-primary border border-white/30 hover:border-white transition-all duration-200">
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
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-primary font-semibold shadow-sm">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/20 text-secondary hover:bg-white hover:text-primary border border-white/30 hover:border-white transition-all duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if ($panduans->hasMorePages())
                                <a href="{{ $panduans->appends(request()->all())->nextPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/20 text-secondary hover:bg-white hover:text-primary border border-white/30 hover:border-white transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white/10 text-secondary/50 border border-white/20 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ✅ FIXED: Bulk Download Form -->
    <form id="bulk-download-form" method="POST" action="{{ route('public.panduan.bulk-download') }}"
        style="display: none;">
        @csrf
        <div id="bulk-download-inputs"></div>
    </form>
</x-public.layouts>


<!-- ✅ FIXED: Updated Mobile Table with Proper JavaScript Integration -->
<div class="lg:hidden">
    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <!-- Mobile Table Header -->
                <thead>
                    <tr class="bg-secondary border-b border-blue-600">
                        <!-- ✅ FIXED: Unique ID untuk mobile header checkbox -->
                        <th class="px-3 py-3 text-center w-10">
                            <input type="checkbox" id="mobile-header-checkbox"
                                class="header-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                onchange="toggleAllCheckboxes(this)" style="position: relative; z-index: 10;"
                                title="Pilih/Batal Semua">
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider w-12">
                            No.
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Nama panduan
                        </th>
                        <th
                            class="px-3 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-16">
                            Tahun
                        </th>
                        <th
                            class="px-3 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-20">
                            Download
                        </th>
                    </tr>
                </thead>

                <!-- Mobile Table Body -->
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($panduans as $index => $panduan)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <!-- ✅ FIXED: Checkbox dengan proper styling dan event handling -->
                            <td class="px-3 py-3 text-center" style="position: relative;">
                                @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                    <input type="checkbox"
                                        class="file-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 cursor-pointer"
                                        value="{{ $panduan->id }}" data-id="{{ $panduan->id }}"
                                        id="mobile-checkbox-{{ $panduan->id }}"
                                        style="position: relative; z-index: 10; min-width: 16px; min-height: 16px;"
                                        onchange="updateBulkDownloadButton()" onclick="event.stopPropagation();">
                                @else
                                    <span class="w-4 h-4 inline-block"></span>
                                @endif
                            </td>

                            <!-- Number -->
                            <td class="px-3 py-3 text-xs font-medium text-secondary">
                                {{ ($panduans->currentPage() - 1) * $panduans->perPage() + $index + 1 }}.
                            </td>

                            <!-- Title dengan Description dan File Size -->
                            <td class="px-3 py-3">
                                <div class="min-w-0">
                                    <div class="font-semibold text-secondary text-sm mb-1 leading-tight">
                                        {{ Str::limit($panduan->title, 60) }}
                                    </div>
                                    <div class="text-xs text-secondary/70 mb-2 leading-relaxed">
                                        {{ Str::limit(strip_tags($panduan->description), 80) }}
                                    </div>
                                    @if ($panduan->formatted_file_size)
                                        <div
                                            class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            {{ $panduan->formatted_file_size }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Year -->
                            <td class="px-3 py-3 text-center">
                                <div class="text-xs font-semibold text-secondary">
                                    @if ($panduan->year_published)
                                        {{ $panduan->year_published }}
                                    @elseif($panduan->created_at)
                                        {{ $panduan->created_at->format('Y') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Download Button -->
                            <td class="px-3 py-3 text-center">
                                @if ($panduan->file_path && file_exists(storage_path('app/public/' . $panduan->file_path)))
                                    <a href="{{ route('panduan.download', $panduan->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-lg 
                                               hover:bg-blue-700 transition-colors shadow-sm touch-target"
                                        title="Download {{ $panduan->title }}" target="_blank">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-400 text-gray-200 rounded-lg cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-8 text-center bg-white">
                                <div class="text-center">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-900 mb-1">Belum ada panduan tersedia</p>
                                    <p class="text-xs text-gray-600">panduan akan segera ditambahkan oleh admin</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
