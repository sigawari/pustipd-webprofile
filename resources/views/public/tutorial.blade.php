@php
    // Data dummy tutorial
    $tutorials = [
        [
            'title' => 'Tutorial Mengganti E-Mail',
            'excerpt' => 'Panduan lengkap cara mengganti email utama pada sistem kampus.',
            'link' => '/tutorial/mengganti-email',
        ],
        [
            'title' => 'Reset/Lupa Akun E-Learning',
            'excerpt' => 'Solusi jika lupa password akun e-learning atau ingin reset akun.',
            'link' => '/tutorial/reset-elearning',
        ],
        [
            'title' => 'Mengganti Password Email',
            'excerpt' => 'Langkah-langkah penggantian sandi email UIN.',
            'link' => '/tutorial/ganti-password-email',
        ],
        [
            'title' => 'Aktivasi Laravel',
            'excerpt' => 'Bagaimana mengaktifkan akun Laravel dan tips pemrograman dasar.',
            'link' => '/tutorial/aktivasi-laravel',
        ],
        [
            'title' => 'Tutorial Makan Ayam',
            'excerpt' => 'Tips efektif menikmati ayam di kantin kampus (dummy contoh).',
            'link' => '/tutorial/makan-ayam',
        ],
        [
            'title' => 'Tutorial Mengganti E-Mail',
            'excerpt' => 'Panduan lengkap cara mengganti email utama pada sistem kampus.',
            'link' => '/tutorial/mengganti-email',
        ],
        [
            'title' => 'Reset/Lupa Akun E-Learning',
            'excerpt' => 'Solusi jika lupa password akun e-learning atau ingin reset akun.',
            'link' => '/tutorial/reset-elearning',
        ],
        [
            'title' => 'Mengganti Password Email',
            'excerpt' => 'Langkah-langkah penggantian sandi email UIN.',
            'link' => '/tutorial/ganti-password-email',
        ],
        [
            'title' => 'Aktivasi Laravel',
            'excerpt' => 'Bagaimana mengaktifkan akun Laravel dan tips pemrograman dasar.',
            'link' => '/tutorial/aktivasi-laravel',
        ],
        [
            'title' => 'Tutorial Makan Ayam',
            'excerpt' => 'Tips efektif menikmati ayam di kantin kampus (dummy contoh).',
            'link' => '/tutorial/makan-ayam',
        ],
    ];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="tutorial" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary m-6 relative inline-block underline-animate">
                    Tutorial
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Beberapa tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden
                    Fatah Palembang
                </h3>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari tutorial di sini...."
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

            <!-- Grid Card Tutorial -->
            <div class="tutorial-grid">
                @foreach ($tutorials as $tutor)
                    <a href="{{ $tutor['link'] }}" class="tutorial-card group" title="{{ $tutor['title'] }}">
                        <div class="tutorial-title group-hover:text-custom-blue transition">{{ $tutor['title'] }}</div>
                        <div class="tutorial-excerpt">{{ $tutor['excerpt'] }}</div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2 mt-7 select-none">
                <!-- Tombol Previous -->
                <button
                    class="flex items-center justify-center w-9 h-9 rounded bg-white text-custom-blue hover:bg-custom-blue hover:text-white transition focus:outline-none"
                    aria-label="Sebelumnya">
                    <!-- Panah kiri: SVG -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 15l-5-5 5-5" />
                    </svg>
                </button>
                <button
                    class="flex items-center justify-center w-9 h-9 rounded bg-custom-blue text-white font-semibold shadow transition focus:outline-none">
                    1
                </button>
                <button
                    class="flex items-center justify-center w-9 h-9 rounded bg-white text-custom-blue hover:bg-custom-blue hover:text-white transition focus:outline-none">
                    2
                </button>
                <button
                    class="flex items-center justify-center w-9 h-9 rounded bg-white text-custom-blue hover:bg-custom-blue hover:text-white transition focus:outline-none">
                    3
                </button>
                <!-- Tombol Next -->
                <button
                    class="flex items-center justify-center w-9 h-9 rounded bg-white text-custom-blue hover:bg-custom-blue hover:text-white transition focus:outline-none"
                    aria-label="Selanjutnya">
                    <!-- Panah kanan: SVG -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 5l5 5-5 5" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
</x-public.layouts>
