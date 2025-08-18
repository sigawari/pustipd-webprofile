<!-- resources/views/public/applayanan.blade.php - Enhanced Card Version -->
<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="py-16 mt-12 bg-primary" id="applayanan">
        <!-- Container dengan margin yang lebih dalam untuk desktop -->
        <div class="container mx-auto px-4 sm:px-8 lg:px-16 xl:px-24">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="text-center mb-8 group">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                        Layanan Digital
                    </h2>
                    <h3 class="text-lg pt-4 text-secondary max-w-3xl mx-auto">
                        Akses cepat ke berbagai aplikasi dan platform digital
                        <span class="font-semibold">PUSTIPD UIN Raden Fatah Palembang</span>
                        untuk mendukung kegiatan akademik dan administratif Anda
                    </h3>
                </div>
            </div>

            <!-- Search & Filter Section -->
            <div class="flex flex-col md:flex-row gap-4 mb-10 max-w-4xl mx-auto">
                <!-- Search Form -->
                <div class="flex-1">
                    <form action="{{ route('applayanan') }}" method="GET" class="relative">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari aplikasi atau layanan..."
                            class="w-full rounded-xl pl-12 pr-4 py-3 text-gray-900 placeholder-gray-500
                                  bg-white border border-gray-200 shadow-sm 
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                  transition-all duration-200" />
                        <button type="submit"
                            class="absolute top-1/2 left-4 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Category Filter -->
                <div class="md:w-64">
                    <form action="{{ route('applayanan') }}" method="GET" id="categoryForm">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="category"
                            class="w-full rounded-xl px-4 py-3 bg-white border border-gray-200 shadow-sm
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                   transition-all duration-200"
                            onchange="document.getElementById('categoryForm').submit()">
                            <option value="">Semua Kategori</option>
                            <option value="akademik" {{ request('category') == 'akademik' ? 'selected' : '' }}>
                                Akademik
                            </option>
                            <option value="pegawai" {{ request('category') == 'pegawai' ? 'selected' : '' }}>
                                Pegawai
                            </option>
                            <option value="pembelajaran" {{ request('category') == 'pembelajaran' ? 'selected' : '' }}>
                                Pembelajaran
                            </option>
                            <option value="administrasi" {{ request('category') == 'administrasi' ? 'selected' : '' }}>
                                Administrasi
                            </option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Results Info -->
            @if (request('search') || request('category'))
                <div class="text-center mb-8">
                    <p class="text-secondary">
                        @if (request('search') && request('category'))
                            Hasil pencarian "<strong>{{ request('search') }}</strong>" dalam kategori
                            "<strong>{{ ucfirst(request('category')) }}</strong>":
                            <span class="font-semibold">{{ $appLayanans->total() }} aplikasi</span>
                        @elseif(request('search'))
                            Hasil pencarian "<strong>{{ request('search') }}</strong>":
                            <span class="font-semibold">{{ $appLayanans->total() }} aplikasi</span>
                        @elseif(request('category'))
                            Kategori "<strong>{{ ucfirst(request('category')) }}</strong>":
                            <span class="font-semibold">{{ $appLayanans->total() }} aplikasi</span>
                        @endif
                    </p>
                </div>
            @endif

            @if ($appLayanans->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                    @foreach ($appLayanans as $appLayanan)
                        @php
                            $iconData = $getCategoryIcon($appLayanan->category);
                        @endphp
                        <div class="group relative">
                            <!-- Card Background with Enhanced Shadow -->
                            <div
                                class="absolute inset-0 bg-white rounded-xl border border-gray-100 shadow-lg 
                                       group-hover:shadow-2xl group-hover:border-gray-200 
                                       transition-all duration-300 transform group-hover:-translate-y-1">
                            </div>

                            <a href="{{ $appLayanan->applink }}" target="_blank" rel="noopener noreferrer"
                                class="relative block p-5 rounded-xl overflow-hidden transition-all duration-300 
                                       cursor-pointer h-full min-h-[160px] flex flex-col"
                                title="Buka {{ $appLayanan->appname }}">

                                <!-- Category Badge with Enhanced Style -->
                                <div
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold 
                                           bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 mb-3 
                                           border border-gray-200 shadow-sm self-start">
                                    <span class="mr-1 text-sm">
                                        @switch($appLayanan->category)
                                            @case('akademik')
                                                🎓
                                            @break

                                            @case('pegawai')
                                                👥
                                            @break

                                            @case('pembelajaran')
                                                📖
                                            @break

                                            @case('administrasi')
                                                📋
                                            @break

                                            @default
                                                📱
                                        @endswitch
                                    </span>
                                    {{ ucfirst($appLayanan->category) }}
                                </div>

                                <!-- Icon and Title Side by Side -->
                                <div class="flex items-center mb-3">
                                    <!-- Icon Container -->
                                    <div
                                        class="flex items-center justify-center w-12 h-12 bg-gradient-to-br {{ $iconData['color'] }} 
                                               rounded-xl mr-3 group-hover:scale-105 transition-all duration-300 shadow-lg
                                               border border-white/20 flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $iconData['icon'] }}" />
                                        </svg>
                                    </div>

                                    <!-- Title -->
                                    <h3
                                        class="text-lg font-bold text-gray-900 group-hover:text-blue-600 
                                               transition-colors duration-300 leading-tight line-clamp-2 flex-1">
                                        {{ $appLayanan->appname }}
                                    </h3>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 leading-relaxed mb-4 text-sm line-clamp-3 flex-grow">
                                    {{ Str::limit($appLayanan->description, 100) }}
                                </p>

                                <!-- Access Button -->
                                <div
                                    class="flex items-center justify-center mt-auto pt-3 border-t border-gray-100 w-full">
                                    <div
                                        class="flex items-center text-blue-600 font-semibold text-sm 
                                               group-hover:text-blue-700 transition-colors duration-300">
                                        <span>Akses Aplikasi</span>
                                        <div
                                            class="ml-2 w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center 
                                                   group-hover:bg-blue-600 group-hover:text-white 
                                                   transition-all duration-300 shadow-sm">
                                            <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform duration-300"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subtle Hover Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-blue-50/0 
                                           group-hover:to-blue-50/20 transition-all duration-300 rounded-xl pointer-events-none">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($appLayanans->hasPages())
                    <div class="flex justify-center items-center">
                        <nav class="flex items-center space-x-2" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($appLayanans->onFirstPage())
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $appLayanans->previousPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-500 hover:text-white border border-gray-200 hover:border-blue-500 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($appLayanans->getUrlRange(1, $appLayanans->lastPage()) as $page => $url)
                                @if ($page == $appLayanans->currentPage())
                                    <span
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-500 text-white font-semibold shadow-sm">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-500 hover:text-white border border-gray-200 hover:border-blue-500 transition-all duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($appLayanans->hasMorePages())
                                <a href="{{ $appLayanans->nextPageUrl() }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-blue-500 hover:text-white border border-gray-200 hover:border-blue-500 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    </a>
                            @endif
                        </nav>
                    </div>

                    <!-- Pagination Info -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-secondary">
                            Menampilkan {{ $appLayanans->firstItem() }} - {{ $appLayanans->lastItem() }}
                            dari {{ $appLayanans->total() }} aplikasi
                        </p>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Aplikasi Ditemukan</h3>
                    <p class="text-gray-600 mb-6">
                        @if (request('search'))
                            Tidak ada aplikasi yang sesuai dengan pencarian "{{ request('search') }}"
                        @elseif(request('category'))
                            Tidak ada aplikasi dalam kategori {{ ucfirst(request('category')) }}
                        @else
                            Belum ada aplikasi yang tersedia saat ini
                        @endif
                    </p>
                    @if (request('search') || request('category'))
                        <a href="{{ route('applayanan') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Lihat Semua Aplikasi
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
</x-public.layouts>
