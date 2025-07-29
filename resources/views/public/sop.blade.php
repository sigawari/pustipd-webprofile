@php
    // Data SOP
    $sop = [
        [
            'title' => 'SOP Mengganti E-Mail',
            'excerpt' => 'Panduan lengkap cara mengganti email utama pada sistem kampus.',
            'link' => '/sop/mengganti-email',
        ],
        [
            'title' => 'Reset/Lupa Akun E-Learning',
            'excerpt' => 'Solusi jika lupa password akun e-learning atau ingin reset akun.',
            'link' => '/sop/reset-elearning',
        ],
        [
            'title' => 'Mengganti Password Email',
            'excerpt' => 'Langkah-langkah penggantian sandi email UIN.',
            'link' => '/sop/ganti-password-email',
        ],
        [
            'title' => 'Aktivasi Laravel',
            'excerpt' => 'Bagaimana mengaktifkan akun Laravel dan tips pemrograman dasar.',
            'link' => '/sop/aktivasi-laravel',
        ],
        [
            'title' => 'SOP Makan Ayam',
            'excerpt' => 'Tips efektif menikmati ayam di kantin kampus (dummy contoh).',
            'link' => '/sop/makan-ayam',
        ],
        [
            'title' => 'SOP Backup Data',
            'excerpt' => 'Prosedur backup data sistem dan database secara berkala.',
            'link' => '/sop/backup-data',
        ],
        [
            'title' => 'SOP Maintenance Server',
            'excerpt' => 'Panduan perawatan server dan troubleshooting umum.',
            'link' => '/sop/maintenance-server',
        ],
        [
            'title' => 'SOP Akses WiFi Kampus',
            'excerpt' => 'Cara mengakses dan troubleshooting WiFi kampus.',
            'link' => '/sop/akses-wifi',
        ],
    ];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="py-20 bg-primary" id="sop">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 m-6">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary m-4 relative inline-block underline-animate">
                    SOP
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Kumpulan dokumen SOP yang terdapat di PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari dokumen SOP di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
                           text-secondary placeholder-gray-400
                           bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
                           focus:outline-none " />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-secondary">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                    </svg>
                </button>
            </form>

            <!-- Grid Card SOP -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($sop as $soperasional)
                    <a href="{{ $soperasional['link'] }}"
                        class="group bg-white rounded-xl p-6 shadow-sm hover:shadow-lg border border-gray-100 hover:border-custom-blue/20 transition-all duration-300 transform hover:-translate-y-1"
                        title="{{ $soperasional['title'] }}">
                        <!-- Icon -->
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-custom-blue/10 rounded-lg mb-4 group-hover:bg-custom-blue/20 transition-colors">
                            <svg class="w-6 h-6 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <!-- Title -->
                        <h3
                            class="text-xl font-semibold text-secondary mb-3 group-hover:text-custom-blue transition-colors line-clamp-2">
                            {{ $soperasional['title'] }}
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ $soperasional['excerpt'] }}
                        </p>

                        <!-- Read More Link -->
                        <div
                            class="flex items-center text-custom-blue font-medium text-sm group-hover:text-custom-blue/80 transition-colors">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2">
                <!-- Previous Button -->
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-400 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Halaman Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Page Numbers -->
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-custom-blue text-white font-semibold shadow-sm transition-all duration-200">
                    1
                </button>
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200">
                    2
                </button>
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200">
                    3
                </button>

                <!-- Next Button -->
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-gray-600 hover:bg-custom-blue hover:text-white border border-gray-200 hover:border-custom-blue transition-all duration-200"
                    aria-label="Halaman Selanjutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
</x-public.layouts>
