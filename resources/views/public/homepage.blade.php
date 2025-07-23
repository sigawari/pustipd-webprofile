<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section
        class="bg-blue-950 from-blue-900 via-purple-900 to-indigo-900 text-amber-50 min-h-screen flex
        items-center">
        <div class="container mx-auto px-6 py-20">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    PUSAT TEKNOLOGI INFORMASI DAN PANGAKALAN DATA
                </h1>
                <h2 class="text-xl md:text-3xl font-semibold mb-6 leading-tight">UIN Raden Fatah Palembang</h2>
            </div>

            <div class="flex justify-center mt-10">
                <form action="#" method="GET" class="relative w-full max-w-md">
                    <button type="submit" class="absolute top-1/2 transform -translate-y-1/2 text-white pr-2">
                        <svg class="w-8 text-gray-800 pl-2 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                    <input type="text" name="search" placeholder="Cari informasi di sini"
                        class="w-full border border-white rounded-lg pl-10 pr-4 py-2 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500" />
                </form>
            </div>
        </div>
    </section>

    <!-- Divisi Section -->
    <section id="divisi" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Divisi PUSTIPD</h2>
                <div class="w-16 h-1 bg-secondary mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <!-- Divisi Jaringan -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2 4h.01M17 16h.01" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Divisi</p>
                    <h3 class="text-lg font-semibold text-gray-800">Jaringan</h3>
                </div>

                <!-- Divisi Pengembangan Aplikasi -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Divisi</p>
                    <h3 class="text-lg font-semibold text-gray-800">Pengembangan Aplikasi</h3>
                </div>

                <!-- Divisi Pangkalan Data -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Divisi</p>
                    <h3 class="text-lg font-semibold text-gray-800">Pangkalan Data</h3>
                </div>
            </div>
        </div>
    </section>


    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-[#E6F6FF]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                <div class="w-16 h-1 bg-secondary mx-auto mb-6"></div>
            </div>

            <!-- Carousel Container dengan isolasi -->
            <div class="relative max-w-7xl mx-auto isolate">
                <div class="carousel-container overflow-hidden relative" id="servicesCarousel">
                    <div class="carousel-wrapper flex transition-transform duration-500 ease-in-out relative z-10"
                        id="carouselWrapper">

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

                <!-- Navigation dengan z-index yang tepat -->
                <div class="flex justify-center items-center mt-8 space-x-4 carousel-navigation relative z-6">
                    <button id="prevBtn"
                        class="p-2 text-custom-blue hover:text-primary transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div class="flex space-x-2" id="indicators">
                        <!-- Indicators will be generated by JavaScript -->
                    </div>

                    <button id="nextBtn"
                        class="p-2 text-custom-blue hover:text-primary transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Progress Bar dengan containment -->
                <div class="mt-6 progress-container relative z-0">
                    <div class="w-full bg-gray-200 rounded-full h-1">
                        <div class="bg-primary h-1 rounded-full transition-all duration-300 ease-out" id="progressBar"
                            style="width: 16.67%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita & Informasi Section yang Diperbaiki -->
    <section id="berita" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Berita dan Informasi</h2>
                <div class="w-16 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Update terbaru seputar berita dan pengumuman penting dari kami
                </p>
            </div>

            <!-- Content Container -->
            <div class="max-w-7xl mx-auto">

                <!-- Berita Section dengan Gambar -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Berita Terbaru</h3>
                        <a href="/berita"
                            class="text-secondary hover:text-primary/80 font-medium flex items-center group">
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
                            image="img/news/kucing-1.jpg" />

                        <x-news-card title="Workshop Digital Transformation untuk UMKM"
                            excerpt="Program pelatihan komprehensif untuk meningkatkan kemampuan digital UMKM di era modern. Peserta akan mendapat sertifikat dan pendampingan berkelanjutan."
                            date="20 Juli 2025" category="Pelatihan" link="/berita/workshop-digital-transformation"
                            image="img/news/kucing-2.jpg" />

                        <x-news-card title="Kerjasama Strategis dengan Universitas Terkemuka"
                            excerpt="Penandatanganan MoU dengan beberapa universitas untuk pengembangan riset teknologi informasi dan transfer knowledge kepada mahasiswa."
                            date="18 Juli 2025" category="Kerjasama" link="/berita/kerjasama-universitas"
                            image="img/news/kucing-3.jpg" />

                    </div>
                </div>

                <!-- Pengumuman Section -->
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Pengumuman Penting</h3>
                        <a href="/pengumuman"
                            class="text-red-500 hover:text-red-600 font-medium flex items-center group">
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
    <section id="tim" class="py-20 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Tim PUSTIPD</h2>
                <div class="w-16 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Tim profesional yang berdedikasi untuk memberikan layanan terbaik
                </p>
            </div>

            <!-- Infinite Carousel Container -->
            <div class="relative">
                <!-- Carousel Track -->
                <div class="flex animate-infinite-scroll" id="teamCarousel">
                    <!-- First Set of Cards -->
                    <x-team-card name="Dr. Ahmad Wijaya" position="Kepala PUSTIPD"
                        description="Visioner dengan pengalaman 15+ tahun dalam teknologi informasi"
                        image="img/team/kepala-pustipd.jpg" />

                    <x-team-card name="Siti Nurhaliza, S.Kom" position="Kepala Divisi Jaringan"
                        description="Expert dalam infrastruktur jaringan dan keamanan sistem"
                        image="img/team/kepala-jaringan.jpg" />

                    <x-team-card name="Budi Santoso, M.T" position="Kepala Divisi Aplikasi"
                        description="Spesialis pengembangan aplikasi dan sistem informasi"
                        image="img/team/kepala-aplikasi.jpg" />

                    <x-team-card name="Diana Putri, S.T" position="Kepala Divisi Data"
                        description="Ahli dalam manajemen data dan business intelligence"
                        image="img/team/kepala-data.jpg" />

                    <x-team-card name="Rizki Pratama, S.T" position="Network Administrator"
                        description="Spesialis maintenance dan monitoring infrastruktur jaringan"
                        image="img/team/network-admin.jpg" />

                    <x-team-card name="Maya Sari, S.Kom" position="UI/UX Designer"
                        description="Kreator pengalaman pengguna yang intuitif dan menarik"
                        image="img/team/ui-designer.jpg" />

                    <!-- Duplicate Set untuk Infinite Effect -->
                    <x-team-card name="Dr. Ahmad Wijaya" position="Kepala PUSTIPD"
                        description="Visioner dengan pengalaman 15+ tahun dalam teknologi informasi"
                        image="img/team/kepala-pustipd.jpg" />

                    <x-team-card name="Siti Nurhaliza, S.Kom" position="Kepala Divisi Jaringan"
                        description="Expert dalam infrastruktur jaringan dan keamanan sistem"
                        image="img/team/kepala-jaringan.jpg" />

                    <x-team-card name="Budi Santoso, M.T" position="Kepala Divisi Aplikasi"
                        description="Spesialis pengembangan aplikasi dan sistem informasi"
                        image="img/team/kepala-aplikasi.jpg" />

                    <x-team-card name="Diana Putri, S.T" position="Kepala Divisi Data"
                        description="Ahli dalam manajemen data dan business intelligence"
                        image="img/team/kepala-data.jpg" />

                    <x-team-card name="Rizki Pratama, S.T" position="Network Administrator"
                        description="Spesialis maintenance dan monitoring infrastruktur jaringan"
                        image="img/team/network-admin.jpg" />

                    <x-team-card name="Maya Sari, S.Kom" position="UI/UX Designer"
                        description="Kreator pengalaman pengguna yang intuitif dan menarik"
                        image="img/team/ui-designer.jpg" />
                </div>

            </div>
        </div>
    </section>

    <!-- Mitra Section dengan Carousel -->
    <section id="mitra" class="py-20 bg-primary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-secondary">Mitra Kami</h2>
                <div class="w-16 h-1 bg-secondary mx-auto mb-3"></div>
            </div>

            <!-- Carousel Container -->
            <div class="relative max-w-7xl mx-auto">
                <div class="carousel-container overflow-hidden" id="partnersCarousel">
                    <div class="carousel-wrapper flex transition-transform duration-500 ease-in-out"
                        id="partnersWrapper">

                        <x-partner-card name="Universitas Indonesia" logo="assets/img/placeholder/mitra.png"
                            link="https://ui.ac.id" />

                        <x-partner-card name="Institut Teknologi Bandung" logo="assets/img/placeholder/mitra.png"
                            link="https://itb.ac.id" />

                        <x-partner-card name="Kementerian Komunikasi dan Informatika"
                            logo="assets/img/placeholder/mitra.png" link="https://kominfo.go.id" />

                        <x-partner-card name="PT. Telkom Indonesia" logo="assets/img/placeholder/mitra.png"
                            link="https://telkom.co.id" />

                        <x-partner-card name="Microsoft Indonesia" logo="assets/img/placeholder/mitra.png"
                            link="https://microsoft.com/id-id" />

                        <x-partner-card name="Google Indonesia" logo="assets/img/placeholder/mitra.png"
                            link="https://google.co.id" />

                        <x-partner-card name="Amazon Web Services" logo="img/partners/aws-logo.png"
                            link="https://aws.amazon.com" />

                        <x-partner-card name="Oracle Indonesia" logo="img/partners/oracle-logo.png"
                            link="https://oracle.com/id" />

                        <x-partner-card name="Cisco Systems" logo="img/partners/cisco-logo.png"
                            link="https://cisco.com" />

                        <x-partner-card name="IBM Indonesia" logo="img/partners/ibm-logo.png"
                            link="https://ibm.com/id" />

                        <x-partner-card name="SAP Indonesia" logo="img/partners/sap-logo.png"
                            link="https://sap.com/indonesia" />

                        <x-partner-card name="VMware Indonesia" logo="img/partners/vmware-logo.png"
                            link="https://vmware.com" />

                    </div>
                </div>

                <!-- Navigation tetap sama -->
                <div class="flex justify-center items-center mt-8 space-x-4">
                    <button id="partnersPrevBtn"
                        class="p-2 text-custom-blue hover:text-gray-300 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div class="flex space-x-2" id="partnersIndicators"></div>

                    <button id="partnersNextBtn"
                        class="p-2 text-custom-blue hover:text-gray-300 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Progress Bar -->
                <div class="mt-6">
                    <div class="w-full bg-gray-600 rounded-full h-1">
                        <div class="bg-white h-1 rounded-full transition-all duration-300 ease-out"
                            id="partnersProgressBar" style="width: 16.67%"></div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-16">
                <h3 class="text-2xl font-bold mb-4 text-primary">Hubungi Kami</h3>
                <p class="text-secondary mb-8 max-w-2xl mx-auto">
                    Isi Form Survey untuk meningkatkan layanan PUSTIPD
                </p>
                <a href="https://www.typeform.com/"
                    class="bg-custom-yellow hover:bg-gray-100 text-secondary px-5 py-4 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                    Isi Survei
                </a>
            </div>
        </div>
    </section>

</x-public.layouts>
