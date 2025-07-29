<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Style for Divisi -->
    <style>
        .underline-animate::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            /* Jarak dari teks */
            left: 0;
            height: 4px;
            width: 0;
            background-color: #062749;
            /* Tailwind blue-500 */
            transition: width 0.4s ease;
        }

        .group:hover .underline-animate::after {
            width: 100%;
        }
    </style>

    <!-- Hero Section -->
    <section id="beranda"
        class="relative bg-blue-950 text-amber-50 min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <img src="{{ asset('assets/img/hero/uin-raden-fatah.jpg') }}" alt="Hero Image"
            class="absolute inset-0 w-full h-full object-cover opacity-40">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black via-secondary to-navy-700 opacity-70"></div>

        <div class="relative z-10 text-center px-4 sm:px-6 w-full max-w-2xl">
            <h1 class="text-2xl sm:text-6xl font-extrabold mb-3 leading-snug sm:leading-tight">
                PUSAT TEKNOLOGI INFORMASI DAN PANGKALAN DATA
            </h1>

            <!-- h2 with logo -->
            <span
                class="text-sm sm:text-lg font-medium mb-6 flex items-center justify-center gap-2 flex-wrap text-white">
                <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="Logo UINRF" class="h-4 sm:h-6">
                <h2 class="text-l sm:text-xl font-bold text-white">UIN Raden Fatah Palembang</h2>
            </span>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari informasi di sini"
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 text-white placeholder-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-white">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z"></path>
                    </svg>
                </button>
            </form>

            <!-- Floating Buttons BELOW Hero -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <!-- Left Button -->
                <a href="#"
                    class="bg-white text-custom-yellow font-medium px-4 py-2 rounded-full shadow-md flex items-center justify-center gap-2 transition transform hover:scale-105 hover:bg-custom-yellow hover:text-white w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3l1-2h4l1 2h3a2 2 0 012 2v11a2 2 0 01-2 2z" />
                    </svg>
                    <h4 class="font-bold">Isi Survei</h4>
                </a>

                <!-- Right Button -->
                <a href="#"
                    class="bg-white text-secondary font-medium px-4 py-2 rounded-full shadow-md flex items-center justify-center gap-2 transition transform hover:scale-105 hover:bg-secondary hover:text-white w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8h3l4-4V6a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h1v4l4-4z" />
                    </svg>
                    <h4 class="font-bold">Tanya PUSTIPD</h4>
                </a>
            </div>
        </div>
    </section>

    {{-- <!-- Divisi Section -->
    <section id="divisi" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Divisi PUSTIPD
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <!-- Card Division -->
                <!-- Jaringan Division -->
                <div
                    class="group rounded-lg border border-gray-200 shadow-lg transition-all duration-300 transform hover:-translate-y-2">
                    <div class="card-animated p-8 text-center rounded-lg">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-15 h-15 text-secondary card-text transition-colors duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2 4h.01M17 16h.01" />
                            </svg>
                        </div>
                        <h4 class="text-sm text-secondary mb-2 card-text">Divisi</h4>
                        <h3 class="text-lg font-bold text-secondary card-text">Jaringan</h3>
                    </div>
                </div>
                <!-- Pengembangan Aplikasi Division -->
                <div
                    class="group rounded-lg border border-gray-200 shadow-lg transition-all duration-300 transform hover:-translate-y-2">
                    <div class="card-animated p-8 text-center rounded-lg">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-15 h-15 text-secondary card-text  transition-colors duration-300 "
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <h4 class="text-sm text-secondary mb-2 card-text">Divisi</h4>
                        <h3 class="text-lg font-bold text-secondary card-text">Pengembangan Aplikasi</h3>
                    </div>
                </div>
                <!-- Pangkalan Data Division -->
                <div
                    class="group rounded-lg border border-gray-200 shadow-lg transition-all duration-300 transform hover:-translate-y-2">
                    <div class="card-animated p-8 text-center rounded-lg">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-secondary card-text  transition-colors duration-300 "
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                        </div>
                        <h4 class="text-sm text-secondary mb-2 card-text">Divisi</h4>
                        <h3 class="text-lg font-bold text-secondary card-text">Pangkalan Data</h3>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Pencapaian Section -->
    <section id="pencapaian" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Pencapaian
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Beberapa pencapaian UIN Raden Fatah Palembang dan PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            @php
                $achievements = [
                    ['subtitle' => 'Juara 1', 'title' => 'Jaringan'],
                    ['subtitle' => 'Juara 1', 'title' => 'Pengembangan Aplikasi'],
                    ['subtitle' => 'Juara 1', 'title' => 'Pangkalan Data'],
                    ['subtitle' => 'Juara 1', 'title' => 'Keamanan'],
                    ['subtitle' => 'Juara 1', 'title' => 'Pengujian'],
                    ['subtitle' => 'Juara 1', 'title' => 'Infrastruktur'],
                    ['subtitle' => 'Juara 1', 'title' => 'Analitik'],
                    ['subtitle' => 'Juara 1', 'title' => 'Desain'],
                    ['subtitle' => 'Juara 1', 'title' => 'Manajemen'],
                    ['subtitle' => 'Juara 1', 'title' => 'Support'],
                ];

                $slidesDesktop = array_chunk($achievements, 5);
                $slidesMobile = array_chunk($achievements, 1);
            @endphp

            <!-- Achievement Carousel Container -->
            <div class="achievement-carousel max-w-6xl mx-auto" data-total-slides-desktop="{{ count($slidesDesktop) }}"
                data-total-slides-mobile="{{ count($slidesMobile) }}" data-duration="4000">

                <div class="relative overflow-hidden">
                    <!-- Desktop Carousel Track -->
                    <div
                        class="achievement-carousel-track-desktop hidden lg:flex transition-transform duration-500 ease-in-out">
                        @foreach ($slidesDesktop as $slideIndex => $slideCards)
                            <div class="w-full flex-shrink-0">
                                <div class="grid grid-cols-5 gap-6">
                                    @foreach ($slideCards as $achievement)
                                        <div class="achievement-card-wrapper">
                                            <x-achievement-card :subtitle="$achievement['subtitle']" :title="$achievement['title']" />
                                        </div>
                                    @endforeach

                                    {{-- Fill empty slots --}}
                                    @if (count($slideCards) < 5)
                                        @for ($i = count($slideCards); $i < 5; $i++)
                                            <div class="achievement-card-wrapper opacity-0 pointer-events-none">
                                                <div class="invisible">
                                                    <x-achievement-card subtitle="Placeholder" title="Placeholder" />
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Mobile Carousel Track - 1 card per slide -->
                    <div
                        class="achievement-carousel-track-mobile flex lg:hidden transition-transform duration-500 ease-in-out">
                        @foreach ($slidesMobile as $slideIndex => $slideCards)
                            <div class="w-full flex-shrink-0">
                                <div class="flex justify-center">
                                    @foreach ($slideCards as $achievement)
                                        <div class="achievement-card-wrapper w-full max-w-xs">
                                            <x-achievement-card :subtitle="$achievement['subtitle']" :title="$achievement['title']" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Desktop Indicators -->
                <div class="hidden lg:flex justify-center mt-8 space-x-3">
                    @foreach ($slidesDesktop as $index => $slide)
                        <button
                            class="achievement-indicator-desktop w-3 h-3 rounded-full transition-all duration-300 bg-secondary hover:bg-custom-blue hover:scale-110">
                        </button>
                    @endforeach
                </div>

                <!-- Mobile Indicators -->
                <div class="flex lg:hidden justify-center mt-8 space-x-3">
                    @foreach ($slidesMobile as $index => $slide)
                        <button
                            class="achievement-indicator-mobile w-3 h-3 rounded-full transition-all duration-300 bg-secondary hover:bg-custom-blue hover:scale-110">
                        </button>
                    @endforeach
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-1 mt-4 overflow-hidden">
                    <div class="achievement-progress-bar bg-secondary h-1 rounded-full transition-all duration-100 ease-linear"
                        style="width: 0%"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-[#E6F6FF]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Layanan Kami
                </h2>
            </div>

            <!-- Carousel Container -->
            <div class="relative isolate">
                <div class="overflow-hidden relative" id="servicesCarousel">
                    <div class="flex transition-transform duration-200 ease-in-out relative z-10" id="carouselWrapper">
                        <x-service-card title="Pengembangan Web"
                            description="Membangun website modern dengan teknologi terdepan seperti Laravel dan Tailwind CSS"
                            link="/layanan/web-development" />

                        <x-service-card title="Konsultasi IT"
                            description="Memberikan saran strategis untuk transformasi digital perusahaan Anda dengan pendekatan terpersonalisasi"
                            link="/layanan/konsultasi-it" />

                        <x-service-card title="UI/UX Design"
                            description="Menciptakan pengalaman pengguna yang intuitif dan menarik dengan desain yang user-centered"
                            link="/layanan/ui-ux-design" />

                        <x-service-card title="Mobile Development"
                            description="Pengembangan aplikasi mobile native dan cross-platform untuk iOS dan Android"
                            link="/layanan/mobile-development" />

                        <x-service-card title="Cloud Solutions"
                            description="Implementasi dan migrasi ke cloud infrastructure dengan keamanan dan skalabilitas tinggi"
                            link="/layanan/cloud-solutions" />

                        <x-service-card title="Data Analytics"
                            description="Analisis data mendalam untuk insight bisnis dan pengambilan keputusan yang lebih baik"
                            link="/layanan/data-analytics" />
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-center items-center mt-8 space-x-4 relative z-20"
                    aria-label="Carousel Navigation">
                    <button id="prevBtn"
                        class="p-2 text-custom-blue hover:text-primary transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Sebelumnya">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div class="flex space-x-2" id="indicators" aria-label="Carousel Indicators">
                        <!-- Indicators will be generated by JS -->
                    </div>

                    <button id="nextBtn"
                        class="p-2 text-custom-blue hover:text-primary transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Berikutnya">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Progress Bar -->
                <div class="mt-6 relative z-0">
                    <div class="w-full bg-gray-200 rounded-full h-1">
                        <div class="bg-primary h-1 rounded-full transition-all duration-300 ease-out" id="progressBar"
                            style="width: 16.67%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita & Informasi Section yang Diperbaiki -->
    <section id="informasi" class="py-20 bg-primary">
        <div class="container mx-auto px-6">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Berita dan Informasi
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Update terbaru seputar berita dan pengumuman penting dari kami
                </h3>
            </div>

            <!-- Content Container -->
            <div class="max-w-7xl mx-auto">

                <!-- Berita Section dengan Gambar -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-secondary">Berita Terbaru</h3>
                        <a href="/berita"
                            class="text-secondary hover:text-custom-blue font-medium flex items-center group">
                            Lihat Semua Berita
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Berita Cards Grid - STRUKTUR YANG BENAR -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 news-grid">
                        <x-news-card title="Peluncuran Sistem Informasi Terbaru PUSTIPD"
                            excerpt="Sistem informasi baru telah diluncurkan untuk meningkatkan pelayanan digital dan efisiensi operasional. Fitur-fitur terbaru mencakup dashboard interaktif dan analytics real-time."
                            date="23 Juli 2025" category="Teknologi" link="/berita/peluncuran-sistem-informasi"
                            image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                        <x-news-card title="Workshop Digital Transformation untuk UMKM"
                            excerpt="Program pelatihan komprehensif untuk meningkatkan kemampuan digital UMKM di era modern. Peserta akan mendapat sertifikat dan pendampingan berkelanjutan."
                            date="20 Juli 2025" category="Pelatihan" link="/berita/workshop-digital-transformation"
                            image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                        <x-news-card title="Kerjasama Strategis dengan Universitas Terkemuka"
                            excerpt="Penandatanganan MoU dengan beberapa universitas untuk pengembangan riset teknologi informasi dan transfer knowledge kepada mahasiswa."
                            date="18 Juli 2025" category="Kerjasama" link="/berita/kerjasama-universitas"
                            image="{{ asset('assets/img/placeholder/dummy.png') }}" />
                    </div>
                </div>

                <!-- Pengumuman Section -->
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-secondary">Pengumuman Penting</h3>
                        <a href="/pengumuman"
                            class="text-secondary hover:text-custom-blue font-medium flex items-center group">
                            Lihat Semua Pengumuman
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Pengumuman Cards Grid -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 announcement-grid">

                        <x-announcement-card title="Maintenance Server Terjadwal - 25 Juli 2025"
                            excerpt="Akan dilakukan maintenance server untuk upgrade sistem pada Kamis, 25 Juli 2025 pukul 01:00 - 05:00 WIB. Mohon maklum atas ketidaknyamanan yang terjadi."
                            date="23 Juli 2025" category="Maintenance" link="/pengumuman/maintenance-server"
                            priority="urgent" />

                        <x-announcement-card title="Pembukaan Pendaftaran Program Magang Teknologi"
                            excerpt="Kesempatan magang untuk mahasiswa jurusan IT dengan durasi 3-6 bulan. Dapatkan pengalaman kerja di lingkungan teknologi terdepan dengan mentor berpengalaman."
                            date="22 Juli 2025" category="Rekrutmen" link="/pengumuman/program-magang"
                            priority="normal" />

                        <x-announcement-card title="Update Kebijakan Keamanan Data Terbaru"
                            excerpt="Pembaruan kebijakan keamanan data untuk compliance dengan standar internasional. Semua pengguna diminta untuk memperbarui password dan mengaktifkan 2FA."
                            date="21 Juli 2025" category="Kebijakan" link="/pengumuman/update-keamanan"
                            priority="urgent" />

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Section dengan Infinite Carousel -->
    <section id="tentang" class="py-20 bg-white overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Tim PUSTIPD
                </h2>
                <h3 class="text-xl text-secondary max-w-2xl mx-auto pt-2">
                    Tim profesional yang berdedikasi untuk memberikan layanan terbaik
                </h3>
            </div>

            <!-- Infinite Carousel Container -->
            <div class="relative overflow-hidden">
                <!-- Carousel Track -->
                <div class="flex animate-infinite-scroll gap-2 sm:gap-4 md:gap-5" id="teamCarousel">
                    <!-- First Set of Cards -->
                    <x-team-card name="Dr. Ahmad Wijaya" position="Kepala PUSTIPD"
                        description="Visioner dengan pengalaman 15+ tahun dalam teknologi informasi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Siti Nurhaliza, S.Kom" position="Kepala Divisi Jaringan"
                        description="Expert dalam infrastruktur jaringan dan keamanan sistem"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Budi Santoso, M.T" position="Kepala Divisi Aplikasi"
                        description="Spesialis pengembangan aplikasi dan sistem informasi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Diana Putri, S.T" position="Kepala Divisi Data"
                        description="Ahli dalam manajemen data dan business intelligence"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Rizki Pratama, S.T" position="Network Administrator"
                        description="Spesialis maintenance dan monitoring infrastruktur jaringan"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Maya Sari, S.Kom" position="UI/UX Designer"
                        description="Kreator pengalaman pengguna yang intuitif dan menarik"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <!-- Duplicate Set untuk Infinite Effect -->
                    <x-team-card name="Dr. Ahmad Wijaya" position="Kepala PUSTIPD"
                        description="Visioner dengan pengalaman 15+ tahun dalam teknologi informasi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Siti Nurhaliza, S.Kom" position="Kepala Divisi Jaringan"
                        description="Expert dalam infrastruktur jaringan dan keamanan sistem"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Budi Santoso, M.T" position="Kepala Divisi Aplikasi"
                        description="Spesialis pengembangan aplikasi dan sistem informasi"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Diana Putri, S.T" position="Kepala Divisi Data"
                        description="Ahli dalam manajemen data dan business intelligence"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Rizki Pratama, S.T" position="Network Administrator"
                        description="Spesialis maintenance dan monitoring infrastruktur jaringan"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />

                    <x-team-card name="Maya Sari, S.Kom" position="UI/UX Designer"
                        description="Kreator pengalaman pengguna yang intuitif dan menarik"
                        image="{{ asset('assets/img/placeholder/dummy.png') }}" />
                </div>
            </div>
        </div>
    </section>

    <!-- Mitra Section dengan Carousel -->
    <section id="mitra" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <!-- Judul -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Mitra Kami
                </h2>
            </div>

            <!-- Carousel -->
            <div class="relative max-w-7xl mx-auto">
                <div class="overflow-hidden" id="partnersCarousel">
                    <div id="partnersWrapper" class="flex transition-transform duration-300 ease-in-out space-x-6">
                        <!-- Partner Cards -->
                        <x-partner-card name="Universitas Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://ui.ac.id" />
                        <x-partner-card name="Institut Teknologi Bandung"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://itb.ac.id" />
                        <x-partner-card name="Kementerian Komunikasi dan Informatika"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://kominfo.go.id" />
                        <x-partner-card name="PT. Telkom Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://telkom.co.id" />
                        <x-partner-card name="Microsoft Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}"
                            link="https://microsoft.com/id-id" />
                        <x-partner-card name="Google Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://google.co.id" />
                        <x-partner-card name="Amazon Web Services"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://aws.amazon.com" />
                        <x-partner-card name="Oracle Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://oracle.com/id" />
                        <x-partner-card name="Cisco Systems" logo="{{ asset('assets/img/placeholder/dummy.png') }}"
                            link="https://cisco.com" />
                        <x-partner-card name="IBM Indonesia" logo="{{ asset('assets/img/placeholder/dummy.png') }}"
                            link="https://ibm.com/id" />
                        <x-partner-card name="SAP Indonesia" logo="{{ asset('assets/img/placeholder/dummy.png') }}"
                            link="https://sap.com/indonesia" />
                        <x-partner-card name="VMware Indonesia"
                            logo="{{ asset('assets/img/placeholder/dummy.png') }}" link="https://vmware.com" />
                    </div>
                </div>

                <!-- Navigasi Carousel -->
                <div class="flex justify-center items-center mt-8 space-x-4">
                    <button id="partnersPrevBtn"
                        class="p-2 text-custom-blue hover:text-white transition disabled:opacity-50">
                        <!-- Panah Kiri (Tanpa Komponen Icon) -->
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div id="partnersIndicators" class="flex space-x-2"></div>

                    <button id="partnersNextBtn"
                        class="p-2 text-custom-blue hover:text-white transition disabled:opacity-50">
                        <!-- Panah Kanan -->
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 6l6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <!-- Progress Bar -->
                <div class="mt-6">
                    <div class="w-full bg-gray-600 rounded-full h-1">
                        <div id="partnersProgressBar"
                            class="bg-white h-1 rounded-full transition-all duration-300 ease-out"
                            style="width: 16.67%"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>


</x-public.layouts>
