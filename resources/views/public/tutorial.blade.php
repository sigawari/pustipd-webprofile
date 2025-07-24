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

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        .tutorial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .tutorial-card {
            background: white;
            border-radius: 0.6rem;
            box-shadow: 0 4px 16px rgba(6, 39, 73, 0.08);
            padding: 1.2rem 1.05rem 1.4rem 1.05rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.23s, transform 0.23s;
            cursor: pointer;
        }

        .tutorial-card:hover {
            box-shadow: 0 8px 32px rgba(6, 39, 73, 0.14);
            transform: translateY(-4px) scale(1.035);
        }

        .tutorial-title {
            font-size: 1.08rem;
            font-weight: 700;
            color: #062749;
            margin-bottom: .45rem;
        }

        .tutorial-excerpt {
            color: #506176;
            font-size: 0.97rem;
            line-height: 1.5;
            min-height: 38px;
        }

        @media (max-width: 640px) {
            .tutorial-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 1.3rem;
            }

            .tutorial-card img {
                width: 56px;
                height: 56px;
            }
        }
    </style>

    <section id="tutorial" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Tutorial
                </h2>
                <p class="text-center text-secondary mb-8 pt-3 max-w-x">
                    Beberapa tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden
                    Fatah Palembang
                </p>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari tutorial di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
                           text-secondary placeholder-gray-400
                           bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
                           focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" />
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
