<footer class="relative bg-[#062749] text-white overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 opacity-50">
        <img src="{{ asset('assets/img/public/footer-texture.png') }}" alt="" class="w-full h-full object-cover">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Logo & Alamat -->
            <div>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="PUSTIPD Logo" class="h-14 mr-3">
                    <div>
                        <h2 class="text-3xl font-bold">PUSTIPD</h2>
                        <p class="text-sm text-blue-200">UIN RADEN FATAH</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-white">Alamat</h3>
                    <p class="text-xs text-blue-100 leading-relaxed">
                        {{ $footerData['address'] ?? 'Gedung Perpustakaan Lt. 4, Jl. Pangeran Ratu (Jakabaring), Kelurahan 5 Ulu, Kecamatan Seberang Ulu I, Kota Palembang, Sumatera Selatan 30267, Indonesia.' }}
                    </p>
                </div>
                <div class="flex gap-3 mt-5">
                    <!-- Social Media Icons -->
                    @if (isset($footerData['social_media']))
                        @foreach ($footerData['social_media'] as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener"
                                class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-[#062749] hover:bg-[#062749] hover:border-white border hover:text-white transform hover:scale-110 hover:-translate-y-1 transition duration-200 ease-out">
                                {!! $social['icon'] !!}
                            </a>
                        @endforeach
                    @else
                        <div class="flex gap-3 mt-5">
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/kimiasains.radenfatah/"
                                class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-[#062749] hover:bg-[#062749] hover:border-white border hover:text-white transform hover:scale-110 hover:-translate-y-1 transition duration-200 ease-out">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M13.028 2c1.125.003 1.696.009 2.189.023l.194.007c.224.008.445.018.712.03c1.064.05 1.79.218 2.427.465c.66.254 1.216.598 1.772 1.153a4.9 4.9 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.012.266.022.487.03.712l.006.194c.015.492.021 1.063.023 2.188l.001.746v1.31a79 79 0 0 1-.023 2.188l-.006.194c-.008.225-.018.446-.03.712c-.05 1.065-.22 1.79-.466 2.428a4.9 4.9 0 0 1-1.153 1.772a4.9 4.9 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465l-.712.03l-.194.006c-.493.014-1.064.021-2.189.023l-.746.001h-1.309a78 78 0 0 1-2.189-.023l-.194-.006a63 63 0 0 1-.712-.031c-1.064-.05-1.79-.218-2.428-.465a4.9 4.9 0 0 1-1.771-1.153a4.9 4.9 0 0 1-1.154-1.772c-.247-.637-.415-1.363-.465-2.428l-.03-.712l-.005-.194A79 79 0 0 1 2 13.028v-2.056a79 79 0 0 1 .022-2.188l.007-.194c.008-.225.018-.446.03-.712c.05-1.065.218-1.79.465-2.428A4.9 4.9 0 0 1 3.68 3.678a4.9 4.9 0 0 1 1.77-1.153c.638-.247 1.363-.415 2.428-.465c.266-.012.488-.022.712-.03l.194-.006a79 79 0 0 1 2.188-.023zM12 7a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 2a3 3 0 1 1 .001 6a3 3 0 0 1 0-6m5.25-3.5a1.25 1.25 0 0 0 0 2.5a1.25 1.25 0 0 0 0-2.5" />
                                </svg>
                            </a>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/uinrafahpalembang/"
                                class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-[#062749] hover:bg-[#062749] hover:border-white border hover:text-white transform hover:scale-110 hover:-translate-y-1 transition duration-200 ease-out">
                                <!-- SVG -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>

                            <!-- YouTube -->
                            <a href="https://www.youtube.com/@uinradenfatahpalembang"
                                class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-[#062749] hover:bg-[#062749] hover:border-white border hover:text-white transform hover:scale-110 hover:-translate-y-1 transition duration-200 ease-out">
                                <!-- SVG -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>

                            <!-- Email -->
                            <a href="mailto:pustipd@radenfatah.ac.id"
                                class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-[#062749] hover:bg-[#062749] hover:border-white border hover:text-white transform hover:scale-110 hover:-translate-y-1 transition duration-200 ease-out">
                                <!-- SVG -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-.904.732-1.636 1.636-1.636h1.082L12 11.367l9.282-7.546h1.082c.904 0 1.636.732 1.636 1.636z" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Aplikasi Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-trigger flex items-center justify-between w-full text-left">
                    <h3 class="text-lg font-semibold">{{ $footerData['applications']['title'] ?? 'Aplikasi' }}</h3>
                    <svg class="footer-dropdown-icon w-5 h-5 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="footer-dropdown-content mt-4 space-y-2">
                    @if (isset($footerData['applications']['items']))
                        @foreach ($footerData['applications']['items'] as $app)
                            <a href="{{ $app['url'] }}"
                                class="block text-sm text-blue-100 hover:text-white transition-colors duration-200"
                                target="_blank">
                                {{ $app['name'] }}
                            </a>
                        @endforeach
                    @else
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Simantap</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Simare
                            mare</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Siakad</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Simak
                            UIN</a>
                    @endif
                </div>
            </div>

            <!-- Universitas Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-trigger flex items-center justify-between w-full text-left">
                    <h3 class="text-lg font-semibold">{{ $footerData['faculties']['title'] ?? 'Universitas' }}</h3>
                    <svg class="footer-dropdown-icon w-5 h-5 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="footer-dropdown-content mt-4 space-y-2">
                    @if (isset($footerData['faculties']['items']))
                        @foreach ($footerData['faculties']['items'] as $faculty)
                            <a href="{{ $faculty['url'] }}"
                                class="block text-sm text-blue-100 hover:text-white transition-colors duration-200"
                                target="_blank">
                                {{ $faculty['name'] }}
                            </a>
                        @endforeach
                    @else
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Ilmu Tarbiyah dan Keguruan</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Sains dan Teknologi</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Syariah dan Hukum</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Ushuluddin dan Pemikiran Islam</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Psikologi</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Adab dan Humaniora</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Ekonomi dan Bisnis Islam</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Dakwah dan Komunikasi</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Fakultas
                            Ilmu Sosial dan Ilmu Politik</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Program
                            Pascasarjana</a>
                    @endif
                </div>
            </div>

            <!-- Lembaga Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-trigger flex items-center justify-between w-full text-left">
                    <h3 class="text-lg font-semibold">{{ $footerData['institutions']['title'] ?? 'Lembaga' }}</h3>
                    <svg class="footer-dropdown-icon w-5 h-5 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="footer-dropdown-content mt-4 space-y-2">
                    @if (isset($footerData['institutions']['items']))
                        @foreach ($footerData['institutions']['items'] as $institution)
                            <a href="{{ $institution['url'] }}"
                                class="block text-sm text-blue-100 hover:text-white transition-colors duration-200"
                                target="_blank">
                                {{ $institution['name'] }}
                            </a>
                        @endforeach
                    @else
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">LPM</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">SPI</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Perpustakaan</a>
                        <a href="#"
                            class="block text-sm text-blue-100 hover:text-white transition-colors duration-200">Laboratorium
                            Terpadu</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-6 pt-4 text-sm text-blue-200 flex flex-col sm:flex-row justify-between items-center gap-2">
            <p>{{ $footerData['copyright'] ?? '© PPID UIN RF Palembang 2025. All Rights Reserved' }}</p>
            <p>{{ $footerData['attribution'] ?? 'Made with' }} <span class="text-red-400">❤</span>
                {{ $footerData['developer'] ?? 'by PUSTIPD UIN RF Palembang' }}</p>
        </div>
    </div>

    <style>
        /* Footer Dropdown Styling */
        .footer-dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .footer-dropdown.active .footer-dropdown-content {
            max-height: 200px;
        }

        .footer-dropdown.active .footer-dropdown-icon {
            transform: rotate(180deg);
        }

        /* Desktop: Always show content, hide dropdown functionality */
        @media (min-width: 1024px) {
            .footer-dropdown-content {
                max-height: none !important;
                overflow: visible !important;
            }

            .footer-dropdown-trigger {
                pointer-events: none;
            }

            .footer-dropdown-icon {
                display: none;
            }
        }

        /* Mobile: Show dropdown functionality */
        @media (max-width: 1023px) {
            .footer-dropdown-trigger {
                cursor: pointer;
                padding: 0.5rem 0;
                margin-bottom: 0.5rem;
            }

            .footer-dropdown-trigger:hover {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 0.25rem;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Only activate dropdown on mobile/tablet
            function initializeFooterDropdowns() {
                const dropdowns = document.querySelectorAll('.footer-dropdown');

                dropdowns.forEach(dropdown => {
                    const trigger = dropdown.querySelector('.footer-dropdown-trigger');

                    // Remove existing event listeners
                    trigger.replaceWith(trigger.cloneNode(true));
                    const newTrigger = dropdown.querySelector('.footer-dropdown-trigger');

                    // Add click event only for mobile
                    if (window.innerWidth < 1024) {
                        newTrigger.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Close other dropdowns
                            dropdowns.forEach(otherDropdown => {
                                if (otherDropdown !== dropdown) {
                                    otherDropdown.classList.remove('active');
                                }
                            });

                            // Toggle current dropdown
                            dropdown.classList.toggle('active');
                        });
                    }
                });
            }

            // Initialize on load
            initializeFooterDropdowns();

            // Reinitialize on window resize
            window.addEventListener('resize', initializeFooterDropdowns);
        });
    </script>
</footer>
