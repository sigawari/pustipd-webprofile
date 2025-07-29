@php
    // Data Layanan Digital
    $layananDigital = [
        [
            'title' => 'Email Kampus UIN RF',
            'description' => 'Akses email resmi mahasiswa dan dosen UIN Raden Fatah Palembang.',
            'link' => 'https://mail.google.com',
            'icon' => 'email',
            'category' => 'Komunikasi',
        ],
        [
            'title' => 'E-Learning SPADA',
            'description' => 'Platform pembelajaran online untuk kuliah daring dan materi perkuliahan.',
            'link' => 'https://spada.radenfatah.ac.id',
            'icon' => 'learning',
            'category' => 'Pembelajaran',
        ],
        [
            'title' => 'SIAKAD Online',
            'description' => 'Sistem Informasi Akademik untuk KRS, KHS, dan administrasi akademik.',
            'link' => 'https://siakad.radenfatah.ac.id',
            'icon' => 'academic',
            'category' => 'Akademik',
        ],
        [
            'title' => 'Portal Mahasiswa',
            'description' => 'Portal khusus mahasiswa untuk mengakses berbagai layanan kampus.',
            'link' => 'https://portal.radenfatah.ac.id',
            'icon' => 'portal',
            'category' => 'Portal',
        ],
        [
            'title' => 'Perpustakaan Digital',
            'description' => 'Akses koleksi buku digital, jurnal, dan referensi akademik online.',
            'link' => 'https://library.radenfatah.ac.id',
            'icon' => 'library',
            'category' => 'Perpustakaan',
        ],
        [
            'title' => 'Google Workspace',
            'description' => 'Suite aplikasi Google untuk kolaborasi dan produktivitas kampus.',
            'link' => 'https://workspace.google.com',
            'icon' => 'workspace',
            'category' => 'Produktivitas',
        ],
        [
            'title' => 'WiFi Kampus',
            'description' => 'Panduan akses dan konfigurasi koneksi WiFi di lingkungan kampus.',
            'link' => 'https://wifi.radenfatah.ac.id',
            'icon' => 'wifi',
            'category' => 'Konektivitas',
        ],
        [
            'title' => 'Helpdesk IT',
            'description' => 'Layanan bantuan teknis untuk masalah sistem dan aplikasi kampus.',
            'link' => 'https://helpdesk.radenfatah.ac.id',
            'icon' => 'support',
            'category' => 'Dukungan',
        ],
    ];

    // Function untuk mendapatkan icon berdasarkan kategori
    function getIcon($iconType)
    {
        $icons = [
            'email' =>
                'M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'learning' =>
                'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
            'academic' =>
                'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
            'portal' =>
                'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
            'library' =>
                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
            'workspace' =>
                'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z',
            'wifi' =>
                'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0',
            'support' =>
                'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25zm0 0V12m0 0l3.75-3.75M12 12l-3.75-3.75',
        ];
        return $icons[$iconType] ?? $icons['portal'];
    }
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-primary to-primary/90" id="layanan-digital">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center">
                <div class="text-center mb-10 group">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-secondary m-4 relative inline-block underline-animate">
                        Layanan Digital
                    </h2>
                    <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                        Akses cepat ke berbagai aplikasi dan platform digital
                        <span class="font-semibold">PUSTIPD UIN Raden Fatah Palembang</span>
                        untuk mendukung kegiatan akademik dan administratif Anda
                    </h3>
                </div>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-10">
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

            <!-- Grid Card Layanan Digital -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-16">
                @foreach ($layananDigital as $index => $layanan)
                    <div class="group relative">
                        <!-- Card Background dengan Gradient -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-lg group-hover:shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2">
                        </div>

                        <!-- Card Content -->
                        <a href="{{ $layanan['link'] }}" target="_blank" rel="noopener noreferrer"
                            class="relative block p-8 rounded-3xl overflow-hidden transition-all duration-500 cursor-pointer"
                            title="Buka {{ $layanan['title'] }}">

                            <!-- Category Badge -->
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-custom-blue/10 text-custom-blue mb-6">
                                {{ $layanan['category'] }}
                            </div>

                            <!-- Icon Container -->
                            <div
                                class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-custom-blue to-custom-blue/80 rounded-2xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="{{ getIcon($layanan['icon']) }}" />
                                </svg>
                            </div>

                            <!-- Title -->
                            <h3
                                class="text-2xl font-bold text-secondary mb-4 group-hover:text-custom-blue transition-colors duration-300 leading-tight">
                                {{ $layanan['title'] }}
                            </h3>

                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3">
                                {{ $layanan['description'] }}
                            </p>

                            <!-- Access Indicator -->
                            <div class="flex items-center justify-between">
                                <div
                                    class="flex items-center text-custom-blue font-semibold group-hover:text-custom-blue/80 transition-colors duration-300">
                                    <span>Akses Aplikasi</span>
                                    <div
                                        class="ml-2 w-6 h-6 rounded-full bg-custom-blue/10 flex items-center justify-center group-hover:bg-custom-blue group-hover:text-white transition-all duration-300">
                                        <svg class="w-3 h-3 transform group-hover:translate-x-0.5 transition-transform duration-300"
                                            fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
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
