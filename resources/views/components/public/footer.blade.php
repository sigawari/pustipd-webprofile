<footer class="relative bg-[#062749] text-white overflow-hidden">
    <!-- Background Texture -->
    <div class="absolute inset-0 opacity-50">
        <img src="{{ asset('images/footer-texture.png') }}" alt="" class="w-full h-full object-cover">
    </div>
        
    <div class="relative z-10 container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Logo and Address Section -->
            <div class="lg:col-span-1">
                <div class="flex items-center mb-6">
                    <img src="{{ asset('images/footer-image.png') }}" alt="PUSTIPD Logo" class="h-16 mr-4">
                    <div>
                        <h2 class="text- font-bold tracking-wider text-white">PUSTIPD</h2>
                    </div>
                </div>
                
                <div class="space-y-2 text-blue-100">
                    <h3 class="font-semibold text-white mb-3">Alamat</h3>
                    <p class="text-sm leading-relaxed">
                        Gedung Perpustakaan Lantai 4, Jl. Pangeran<br>
                        Ratu (Jakabaring), Kelurahan 5 Ulu,<br>
                        Kecamatan Seberang Ulu I, Kota Palembang,
                        Sumatera Selatan 30267, Indonesia.
                    </p>
                </div>
                
                <!-- Social Media Icons -->
                <div class="flex space-x-3 mt-6">
                    <!-- Instagram -->
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors duration-300" style="color: #062749;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors duration-300" style="color: #062749;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors duration-300" style="color: #062749;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    <!-- Email -->
                    <a href="mailto:" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors duration-300" style="color: #062749;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-.904.732-1.636 1.636-1.636h1.082L12 11.367l9.282-7.546h1.082c.904 0 1.636.732 1.636 1.636z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Applications Section -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 text-white">Aplikasi</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Simantap</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Simare mare</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Siakad</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Simak UIN</a></li>
                </ul>
            </div>
            
            <!-- Universities Section -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 text-white">Universitas</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Ilmu Tarbiyah dan Keguruan</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Sains dan Teknologi</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Syariah dan Hukum</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Ushuluddin dan Pemikiran Islam</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Psikologi</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Adab dan Humaniora</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Ekonomi dan Bisnis Islam</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Dakwah dan Komunikasi</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Fakultas Ilmu Sosial dan Ilmu Politik</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Program Pascasarjana</a></li>
                </ul>
            </div>
            
            <!-- Institutions Section -->
            <div class="lg:col-span-1">
                <h3 class="text-xl font-bold mb-6 text-white">Lembaga</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Lembaga Penjaminan Mutu (LPM)</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Satuan Pengawasan Internal (SPI)</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Perpustakaan</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">Laboratorium Terpadu</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Copyright Section -->
        <div class="border-t border-blue-700/80 mt-12 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-blue-200 text-sm">
                    Copyright © PPID UIN SGD 2025 All Right Reserved
                </p>
                <p class="text-blue-200 text-sm flex items-center">
                    Made with <span class="text-red-400 mx-1">❤</span> by PUSTIPD UIN RF Palembang
                </p>
            </div>
        </div>
    </div>
</footer>