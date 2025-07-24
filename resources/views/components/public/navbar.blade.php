<!-- WRAPPER NAVBAR -->
<div id="navbar-wrapper" class="fixed top-0 left-0 w-full z-50">

    <!-- Upper Navbar -->
    <div id="topbar" class="bg-transparent  text-white border-b border-white text-xs sm:text-sm px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between py-2 space-y-2 sm:space-y-0">
                <!-- LEFT : contact -->
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center space-x-1">
                        <!-- Email -->
                        <svg class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:pustipd@radenfatah.ac.id">pustipd@radenfatah.ac.id</a>
                    </div>

                    <span class="hidden sm:inline-block w-px h-4 bg-white"></span>

                    <div class="flex items-center space-x-1">
                        <!-- Lokasi -->
                        <svg class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0Z" />
                        </svg>
                        <a href="https://maps.app.goo.gl/hcLnxHRaKm5De6hc7">
                            Perpustakaan Lt. 4 Kampus B UIN RF Jakabaring
                        </a>
                    </div>
                </div>

                <!-- RIGHT : clock -->
                <div class="flex items-center space-x-4">
                    <span class="hidden sm:inline-block w-px h-4 bg-white"></span>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-clock text-white text-xs"></i>
                        <span id="open-status" class="font-semibold uppercase"></span>
                        <span id="clock"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav id="navbar" class="bg-transparent transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo + Title -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="PUSTIPD Logo"
                        class="w-10 h-10 object-contain">
                    <a href="#beranda" id="navbar-title"
                        class="text-xl lg:text-2xl font-bold font-sans text-white">PUSTIPD</a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <a href="#beranda" class="text-white">
                        <h3>Beranda</h3>
                    </a>
                    <a href="#tentang" class="text-white">
                        <h3>Tentang Kami</h3>
                    </a>
                    <a href="#layanan" class="text-white">
                        <h3>Layanan</h3>
                    </a>
                    <a href="#informasi" class="text-white">
                        <h3>Informasi</h3>
                    </a>
                    <a href="#sop" class="text-white">
                        <h3>SOP</h3>
                    </a>
                    <a href="#faq" class="text-white">
                        <h3>FAQ</h3>
                    </a>
                </div>

                <!-- Mobile Toggle -->
                <div class="lg:hidden">
                    <button id="mobile-menu-toggle" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="lg:hidden hidden bg-transparent backdrop-blur-xs text-white px-4 py-4 space-y-2 shadow-md rounded-b-lg transition-all duration-300">
        <a href="#beranda" class="block">Beranda</a>
        <a href="#tentang" class="block">Tentang Kami</a>
        <a href="#layanan" class="block">Layanan</a>
        <a href="#informasi" class="block">Informasi Terkini</a>
        <a href="#sop" class="block">SOP</a>
        <a href="#faq" class="block">FAQ</a>
    </div>
</div>

<script>
    // Script Hide Upper Navbar on Scroll
    const topbar = document.getElementById('topbar');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            topbar.classList.add('hidden');
        } else {
            topbar.classList.remove('hidden');
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Optional: auto-close menu setelah klik link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    });
</script>
