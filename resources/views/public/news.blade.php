<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Berita & Informasi Section -->
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

        /* Supaya card tidak terlalu tinggi dan proporsional */
        .news-grid>* {
            /* Contoh kontrol tinggi card, sesuaikan jika perlu */
            min-height: 250px;
            display: flex;
            flex-direction: column;
        }
    </style>

    <section id="berita" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Berita PUSTIPD
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Berita terbaru dari kami
                </h3>
            </div>

            <!-- Content Container -->
            <div class="max-w-8xl mx-auto">
                <!-- Berita Cards Grid -->
                <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 news-grid">
                    <x-newspage-card title="Peluncuran Sistem Informasi Terbaru PUSTIPD"
                        excerpt="Sistem informasi baru telah diluncurkan untuk meningkatkan pelayanan digital dan efisiensi operasional. Fitur-fitur terbaru mencakup dashboard interaktif dan analytics real-time."
                        date="23 Juli 2025" category="Teknologi" link="/berita/peluncuran-sistem-informasi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-newspage-card title="Workshop Digital Transformation untuk UMKM"
                        excerpt="Program pelatihan komprehensif untuk meningkatkan kemampuan digital UMKM di era modern. Peserta akan mendapat sertifikat dan pendampingan berkelanjutan."
                        date="20 Juli 2025" category="Pelatihan" link="/berita/workshop-digital-transformation"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-newspage-card title="Kerjasama Strategis dengan Universitas Terkemuka"
                        excerpt="Penandatanganan MoU dengan beberapa universitas untuk pengembangan riset teknologi informasi dan transfer knowledge kepada mahasiswa."
                        date="18 Juli 2025" category="Kerjasama" link="/berita/kerjasama-universitas"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <!-- Dummy cards tambahan supaya terlihat 6 card per baris di layar lg -->
                    <x-newspage-card title="Pengembangan Aplikasi Mobile PUSTIPD"
                        excerpt="Tim developer kami sedang mengerjakan aplikasi mobile terbaru untuk kemudahan akses layanan online."
                        date="17 Juli 2025" category="Teknologi" link="/berita/pengembangan-aplikasi-mobile"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-newspage-card title="Seminar Nasional Teknologi Informasi"
                        excerpt="Rangkaian seminar nasional menghadirkan pembicara inspiratif dari industri IT dan akademisi."
                        date="15 Juli 2025" category="Seminar" link="/berita/seminar-nasional-teknologi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-newspage-card title="Pendampingan UMKM Digital"
                        excerpt="Program pendampingan intensif untuk membantu UMKM bertransformasi digital."
                        date="10 Juli 2025" category="Pelatihan" link="/berita/pendampingan-umkm-digital"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

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
