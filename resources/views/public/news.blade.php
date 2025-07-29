@php
    // Dummy data berita - dikurangi menjadi 6 item untuk tampilan yang lebih rapi
    $newsList = [
        [
            'title' => 'Peluncuran Sistem Informasi Terbaru PUSTIPD',
            'excerpt' =>
                'Sistem informasi baru telah diluncurkan untuk meningkatkan pelayanan digital dan efisiensi operasional. Fitur-fitur terbaru mencakup dashboard interaktif dan analytics real-time.',
            'date' => '23 Juli 2025',
            'category' => 'Teknologi',
            'link' => '/berita/contohberita',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
        [
            'title' => 'Workshop Digital Transformation untuk UMKM',
            'excerpt' =>
                'Program pelatihan komprehensif untuk meningkatkan kemampuan digital UMKM di era modern. Peserta akan mendapat sertifikat dan pendampingan berkelanjutan.',
            'date' => '20 Juli 2025',
            'category' => 'Pelatihan',
            'link' => '/berita/workshop-digital-transformation',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
        [
            'title' => 'Kerjasama Strategis dengan Universitas Terkemuka',
            'excerpt' =>
                'Penandatanganan MoU dengan beberapa universitas untuk pengembangan riset teknologi informasi dan transfer knowledge kepada mahasiswa.',
            'date' => '18 Juli 2025',
            'category' => 'Kerjasama',
            'link' => '/berita/kerjasama-universitas',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
        [
            'title' => 'Pengembangan Aplikasi Mobile PUSTIPD',
            'excerpt' =>
                'Tim developer kami sedang mengerjakan aplikasi mobile terbaru untuk kemudahan akses layanan online.',
            'date' => '17 Juli 2025',
            'category' => 'Teknologi',
            'link' => '/berita/pengembangan-aplikasi-mobile',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
        [
            'title' => 'Seminar Nasional Teknologi Informasi',
            'excerpt' => 'Rangkaian seminar nasional menghadirkan pembicara inspiratif dari industri IT dan akademisi.',
            'date' => '15 Juli 2025',
            'category' => 'Seminar',
            'link' => '/berita/seminar-nasional-teknologi',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
        [
            'title' => 'Pendampingan UMKM Digital',
            'excerpt' => 'Program pendampingan intensif untuk membantu UMKM bertransformasi digital.',
            'date' => '10 Juli 2025',
            'category' => 'Pelatihan',
            'link' => '/berita/pendampingan-umkm-digital',
            'image' => asset('assets/img/placeholder/dummy.png'),
        ],
    ];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Berita & Informasi Section -->
    <section id="berita" class="py-24 bg-primary h-full">
        <div class="container mx-auto px-4 md:px-12">
            <!-- Header Section -->
            <div class="text-center mb-8 md:mb-10 group">
                <h2
                    class="text-2xl md:text-3xl lg:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Berita PUSTIPD
                </h2>
                <h3 class="text-base md:text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Berita terbaru dari kami
                </h3>
            </div>

            <!-- Content Container -->
            <div class="max-w-6xl mx-auto">
                <!-- Search Form -->
                <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                    <input type="text" name="search" placeholder="Cari Berita di sini...."
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

                <!-- Berita Cards Grid - Responsif: 1 kolom mobile, 2 kolom tablet, 3 kolom desktop -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 news-grid">
                    @foreach ($newsList as $news)
                        <x-newspage-card title="{{ $news['title'] }}" excerpt="{{ $news['excerpt'] }}"
                            date="{{ $news['date'] }}" category="{{ $news['category'] }}" link="{{ $news['link'] }}"
                            image="{{ $news['image'] }}" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center gap-2 mt-8 md:mt-12 select-none">
                    <!-- Tombol Previous -->
                    <button
                        class="flex items-center justify-center w-9 h-9 rounded bg-white text-custom-blue hover:bg-custom-blue hover:text-white transition focus:outline-none"
                        aria-label="Sebelumnya">
                        <!-- Panah kiri: SVG -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 15l-5-5 5-5" />
                        </svg>
                    </button>
                    <!-- Contoh Halaman (angka, tanpa garis tambahan) -->
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
        </div>
    </section>
</x-public.layouts>
