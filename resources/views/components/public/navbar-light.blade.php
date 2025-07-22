    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">

                <!-- Logo Section -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex items-center space-x-3">
                        <!-- Logo Image -->
                        <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 flex items-center justify-center">
                            <img src="{{ asset('images/footer-image.png') }}" alt="PUSTIPD Logo"
                                class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 object-contain";
                                this.nextElementSibling.style.display='block';">
                            <!-- Fallback Icon -->
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-white hidden" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <!-- Logo Text -->
                        <div class="hidden sm:block">
                            <a href="#beranda" class="text-xl lg:text-2xl font-bold text-[#062749] font-sans">
                                <h1 class="text-xl lg:text-2xl font-bold text-[#062749] font-sans">PUSTIPD</h1>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-1 xl:space-x-4">
                    <a href="#beranda"
                        class="px-3 xl:px-4 py-2 text-sm xl:text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                        Beranda
                    </a>
                    <a href="#tentang"
                        class="px-3 xl:px-4 py-2 text-sm xl:text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                        Tentang Kami
                    </a>
                    <a href="#layanan"
                        class="px-3 xl:px-4 py-2 text-sm xl:text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                        Layanan
                    </a>
                    <a href="#informasi"
                        class="px-3 xl:px-4 py-2 text-sm xl:text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                        Informasi Terkini
                    </a>
                    <a href="#sop"
                        class="px-3 xl:px-4 py-2 text-sm xl:text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                        SOP
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button type="button" id="mobile-menu-btn"
                        class="bg-gray-50 p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-3 space-y-2">
                <a href="#beranda"
                    class="block px-4 py-3 text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                    Beranda
                </a>
                <a href="#tentang"
                    class="block px-4 py-3 text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                    Tentang Kami
                </a>
                <a href="#layanan"
                    class="block px-4 py-3 text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                    Layanan
                </a>
                <a href="#informasi"
                    class="block px-4 py-3 text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                    Informasi Terkini
                </a>
                <a href="#sop"
                    class="block px-4 py-3 text-base font-medium text-[#062749] hover:font-bold hover:bg-gray-50 rounded-lg transition-all duration-200 font-custom">
                    SOP
                </a>
            </div>
        </div>
        <!-- JavaScript for Mobile Menu Toggle -->
        <script>
            document.getElementById('mobile-menu-btn').addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                const menuIcon = document.getElementById('menu-icon');
                const closeIcon = document.getElementById('close-icon');

                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            // Close mobile menu when clicking on a link
            const mobileLinks = document.querySelectorAll('#mobile-menu a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.add('hidden');
                    document.getElementById('menu-icon').classList.remove('hidden');
                    document.getElementById('close-icon').classList.add('hidden');
                });
            });
        </script>
    </nav>
