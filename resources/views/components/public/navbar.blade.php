<!-- WRAPPER NAVBAR -->
<div id="navbar-wrapper" class="fixed top-0 left-0 w-full z-50">

    <!-- Upper Navbar -->
    <div id="topbar" class="bg-transparent  text-white border-b border-white text-xs sm:text-sm px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between py-2 space-y-2 sm:space-y-0">
                <!-- LEFT : contact -->
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center space-x-1">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                        </svg>

                        <a href="mailto:pustipd@radenfatah.ac.id">pustipd@radenfatah.ac.id</a>
                    </div>

                    <span class="hidden sm:inline-block w-px h-4 bg-white"></span>

                    <div class="flex items-center space-x-1">
                        <!-- Lokasi -->
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
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
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
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
                    <a href="/" id="navbar-title"
                        class="text-xl lg:text-2xl font-bold font-sans text-white">PUSTIPD</a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <div class="flex items-center space-x-4">
                        <div>
                            <a href="/">
                                <button class="text-white  transition focus:outline-none">
                                    <h3 class="navbar-menu hover:text-custom-blue">Beranda</h3>
                                </button>
                            </a>
                        </div>

                        <div class="relative group">
                            <button class="flex items-center transition focus:outline-none text-white text-center">
                                <h3 class="text-white navbar-menu hover:text-custom-blue">Tentang Kami</h3>
                                <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-56 shadow-lg rounded-lg py-2 z-30 opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-200 bg-gray-800">
                                <a href="/tentang">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Tentang PUSTIPD
                                    </button>
                                </a>
                                <a href="/visi-misi">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Visi Misi
                                    </button>
                                </a>
                                <a href="/struktur">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Struktur Organisasi
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div>
                            <a href="/applayanan">
                                <button class="text-white  transition focus:outline-none">
                                    <h3 class="navbar-menu hover:text-custom-blue">Layanan</h3>
                                </button>
                            </a>
                        </div>

                        <div class="relative group">
                            <button class="flex items-center transition focus:outline-none text-white">
                                <h3 class="text-white navbar-menu hover:text-custom-blue">Informasi Terkini</h3>
                                <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-56 shadow-lg rounded-lg py-2 z-30 opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-200 bg-gray-800">
                                <a href="/berita">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Berita
                                    </button>
                                </a>
                                <a href="/pengumuman">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Pengumuman
                                    </button>
                                </a>
                                <a href="/tutorial">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Tutorial
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="relative group">
                            <button class="flex items-center transition focus:outline-none text-white">
                                <h3 class="text-white navbar-menu hover:text-custom-blue">Dokumen</h3>
                                <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-56 shadow-lg rounded-lg py-2 z-30 opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-200 bg-gray-800">
                                <a href="/ketetapan">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Ketetapan
                                    </button>
                                </a>
                                <a href="/panduan">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Panduan
                                    </button>
                                </a>
                                <a href="/regulasi">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        Regulasi
                                    </button>
                                </a>
                                <a href="/sop">
                                    <button
                                        class="block w-full px-5 py-2 text-white text-justify hover:bg-gray-700 transition">
                                        SOP
                                    </button>
                                </a>
                            </div>
                        </div>

                        {{-- Di komen dulu kita fokus sama yang sudah ada --}}
                        {{-- <div>
                            <a href="/pendaftaran">
                                <button class="text-white  transition focus:outline-none">
                                    <h3 class="navbar-menu hover:text-custom-blue">Pendaftaran</h3>
                                </button>
                            </a>
                        </div> --}}

                        <div>
                            <a href="/faq">
                                <button class="text-white  transition focus:outline-none">
                                    <h3 class="navbar-menu hover:text-custom-blue">FAQ</h3>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Toggle -->
                <div class="lg:hidden">
                    <button id="mobile-menu-toggle" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="lg:hidden hidden bg-primary opacity-85 backdrop-blur-xs text-secondary px-4 py-4 space-y-2 shadow-md rounded-lg transition-all duration-300">

        <div class="relative">
            <a href="/" class="block px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Beranda</span>
            </a>
        </div>

        <div class="relative">
            <button id="dropdownTentangToggle" type="button"
                class="w-full flex justify-between items-center px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Tentang Kami</span>
                <svg id="dropdownTentangChevron"
                    class="w-4 h-4 ml-1 transform transition-transform duration-200 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="dropdownTentangMenu" class="hidden flex-col space-y-1 mt-1 pl-4">
                <a href="/tentang" class="block text-secondary hover:text-custom-blue">Tentang PUSTIPD</a>
                <a href="/visi-misi" class="block text-secondary hover:text-custom-blue">Visi Misi</a>
                <a href="/struktur" class="block text-secondary hover:text-custom-blue">Struktur Organisasi</a>
            </div>
        </div>

        <div class="relative">
            <a href="/applayanan"
                class="block px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Layanan</span>
            </a>
        </div>

        <div class="relative">
            <button id="dropdownInformasiToggle" type="button"
                class="w-full flex justify-between items-center px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Informasi Terkini</span>
                <svg id="dropdownInformasiChevron"
                    class="w-4 h-4 ml-1 transform transition-transform duration-200 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="dropdownInformasiMenu" class="hidden flex-col space-y-1 mt-1 pl-4">
                <a href="/berita" class="block text-secondary hover:text-custom-blue">Berita</a>
                <a href="/pengumuman" class="block text-secondary hover:text-custom-blue">Pengumuman</a>
                <a href="/tutorial" class="block text-secondary hover:text-custom-blue">Tutorial</a>
            </div>
        </div>

        <div class="relative">
            <button id="dropdownDokumenToggle" type="button"
                class="w-full flex justify-between items-center px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Dokumen</span>
                <svg id="dropdownDokumenChevron"
                    class="w-4 h-4 ml-1 transform transition-transform duration-200 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="dropdownDokumenMenu" class="hidden flex-col space-y-1 mt-1 pl-4">
                <a href="/ketetapan" class="block text-secondary hover:text-custom-blue">Ketetapan</a>
                <a href="/panduan" class="block text-secondary hover:text-custom-blue">Panduan</a>
                <a href="/regulasi" class="block text-secondary hover:text-custom-blue">Regulasi</a>
                <a href="/sop" class="block text-secondary hover:text-custom-blue">SOP</a>
            </div>
        </div>

        {{-- <div class="relative">
            <a href="/pendaftaran"
                class="block px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>Pendaftaran</span>
            </a>
        </div> --}}

        <div class="relative">
            <a href="/faq" class="block px-0 py-2 text-left focus:outline-none hover:text-custom-blue transition">
                <span>FAQ</span>
            </a>
        </div>
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
        if (!isHome) {
            setToggleColor(true);
        } else {
            setToggleColor(window.scrollY > 50);
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const navbar = document.getElementById('navbar');

        // Cek Home atau tidak
        const isHome = window.location.pathname === '/';

        // FUNGSI SET WARNA HAMBURGER
        function setToggleColor(isWhite) {
            if (menuToggle) {
                menuToggle.classList.toggle('text-secondary', isWhite);
                menuToggle.classList.toggle('text-white', !isWhite);
            }
        }

        // Inisialisasi awal
        setToggleColor(!isHome);

        // Toggle mobile menu
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Close mobile menu when clicking menu links
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Helper function to close all mobile dropdowns
        function closeAllMobileDropdowns() {
            const dropdowns = [{
                    menu: document.getElementById('dropdownTentangMenu'),
                    chevron: document.getElementById('dropdownTentangChevron')
                },
                {
                    menu: document.getElementById('dropdownInformasiMenu'),
                    chevron: document.getElementById('dropdownInformasiChevron')
                },
                {
                    menu: document.getElementById('dropdownDokumenMenu'),
                    chevron: document.getElementById('dropdownDokumenChevron')
                }
            ];

            dropdowns.forEach(dropdown => {
                if (dropdown.menu && dropdown.chevron) {
                    dropdown.menu.classList.add('hidden');
                    dropdown.chevron.classList.remove('rotate-180');
                }
            });
        }

        // Dropdown Mobile - Tentang Kami
        const dropdownTentangToggle = document.getElementById('dropdownTentangToggle');
        const dropdownTentangMenu = document.getElementById('dropdownTentangMenu');
        const dropdownTentangChevron = document.getElementById('dropdownTentangChevron');

        if (dropdownTentangToggle) {
            dropdownTentangToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = dropdownTentangMenu.classList.contains('hidden');

                // Close other dropdowns first
                const dropdownInformasiMenu = document.getElementById('dropdownInformasiMenu');
                const dropdownInformasiChevron = document.getElementById('dropdownInformasiChevron');
                const dropdownDokumenMenu = document.getElementById('dropdownDokumenMenu');
                const dropdownDokumenChevron = document.getElementById('dropdownDokumenChevron');

                if (dropdownInformasiMenu) {
                    dropdownInformasiMenu.classList.add('hidden');
                    dropdownInformasiChevron.classList.remove('rotate-180');
                }
                if (dropdownDokumenMenu) {
                    dropdownDokumenMenu.classList.add('hidden');
                    dropdownDokumenChevron.classList.remove('rotate-180');
                }

                if (isHidden) {
                    dropdownTentangMenu.classList.remove('hidden');
                    dropdownTentangChevron.classList.add('rotate-180');
                } else {
                    dropdownTentangMenu.classList.add('hidden');
                    dropdownTentangChevron.classList.remove('rotate-180');
                }
            });
        }

        // Dropdown Mobile - Informasi Terkini  
        const dropdownInformasiToggle = document.getElementById('dropdownInformasiToggle');
        const dropdownInformasiMenu = document.getElementById('dropdownInformasiMenu');
        const dropdownInformasiChevron = document.getElementById('dropdownInformasiChevron');

        if (dropdownInformasiToggle) {
            dropdownInformasiToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = dropdownInformasiMenu.classList.contains('hidden');

                // Close other dropdowns first
                const dropdownTentangMenu = document.getElementById('dropdownTentangMenu');
                const dropdownTentangChevron = document.getElementById('dropdownTentangChevron');
                const dropdownDokumenMenu = document.getElementById('dropdownDokumenMenu');
                const dropdownDokumenChevron = document.getElementById('dropdownDokumenChevron');

                if (dropdownTentangMenu) {
                    dropdownTentangMenu.classList.add('hidden');
                    dropdownTentangChevron.classList.remove('rotate-180');
                }
                if (dropdownDokumenMenu) {
                    dropdownDokumenMenu.classList.add('hidden');
                    dropdownDokumenChevron.classList.remove('rotate-180');
                }

                if (isHidden) {
                    dropdownInformasiMenu.classList.remove('hidden');
                    dropdownInformasiChevron.classList.add('rotate-180');
                } else {
                    dropdownInformasiMenu.classList.add('hidden');
                    dropdownInformasiChevron.classList.remove('rotate-180');
                }
            });
        }

        // Dropdown Mobile - Dokumen
        const dropdownDokumenToggle = document.getElementById('dropdownDokumenToggle');
        const dropdownDokumenMenu = document.getElementById('dropdownDokumenMenu');
        const dropdownDokumenChevron = document.getElementById('dropdownDokumenChevron');

        if (dropdownDokumenToggle) {
            dropdownDokumenToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = dropdownDokumenMenu.classList.contains('hidden');

                // Close other dropdowns first
                const dropdownTentangMenu = document.getElementById('dropdownTentangMenu');
                const dropdownTentangChevron = document.getElementById('dropdownTentangChevron');
                const dropdownInformasiMenu = document.getElementById('dropdownInformasiMenu');
                const dropdownInformasiChevron = document.getElementById('dropdownInformasiChevron');

                if (dropdownTentangMenu) {
                    dropdownTentangMenu.classList.add('hidden');
                    dropdownTentangChevron.classList.remove('rotate-180');
                }
                if (dropdownInformasiMenu) {
                    dropdownInformasiMenu.classList.add('hidden');
                    dropdownInformasiChevron.classList.remove('rotate-180');
                }

                if (isHidden) {
                    dropdownDokumenMenu.classList.remove('hidden');
                    dropdownDokumenChevron.classList.add('rotate-180');
                } else {
                    dropdownDokumenMenu.classList.add('hidden');
                    dropdownDokumenChevron.classList.remove('rotate-180');
                }
            });
        }

        function setNavbarTeksColor(isSecondary) {
            // Get all desktop dropdown elements
            const desktopDropdowns = document.querySelectorAll('.group > div');
            const desktopButtons = document.querySelectorAll('.group > button');
            const navbarMenus = document.querySelectorAll('.navbar-menu');
            const navbarTitle = document.getElementById('navbar-title');

            // Set navbar title color
            if (navbarTitle) {
                navbarTitle.classList.toggle('text-secondary', isSecondary);
                navbarTitle.classList.toggle('text-white', !isSecondary);
            }

            // Set menu item colors
            navbarMenus.forEach(menu => {
                menu.classList.toggle('text-secondary', isSecondary);
                menu.classList.toggle('text-white', !isSecondary);
            });

            // Set dropdown button colors
            desktopButtons.forEach(button => {
                button.classList.toggle('text-secondary', isSecondary);
                button.classList.toggle('text-white', !isSecondary);
            });

            // Set dropdown background and link colors
            desktopDropdowns.forEach(dropdown => {
                dropdown.classList.toggle('bg-white', isSecondary);
                dropdown.classList.toggle('bg-gray-800', !isSecondary);

                dropdown.querySelectorAll('a button').forEach(link => {
                    link.classList.toggle('text-secondary', isSecondary);
                    link.classList.toggle('text-white', !isSecondary);
                    link.classList.toggle('hover:bg-gray-100', isSecondary);
                    link.classList.toggle('hover:text-custom-blue', isSecondary);
                    link.classList.toggle('hover:bg-gray-700', !isSecondary);
                });
            });
        }

        // Initial setup
        setNavbarTeksColor(!isHome);

        window.addEventListener('scroll', function() {
            if (!isHome) {
                setNavbarTeksColor(true);
            } else {
                setNavbarTeksColor(window.scrollY > 50);
            }
        });
    });
</script>
