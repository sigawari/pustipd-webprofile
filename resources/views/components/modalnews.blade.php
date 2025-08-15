<!-- Modal Pop-up Berita & Pengumuman dengan Animasi, Overlay Tipis, dan Carousel Responsif -->
<div id="newsAnnouncementModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 transition-opacity duration-500 opacity-0 pointer-events-none px-2">
    <div id="modalWindow"
        class="bg-white rounded-xl shadow-2xl w-full max-w-sm sm:max-w-md p-3 sm:p-4 relative scale-95 translate-y-8 transition-all duration-500 max-h-[90vh] overflow-hidden">
        <button id="closeModalBtn"
            class="absolute top-2 right-2 text-secondary hover:text-red-600 text-xl font-bold leading-none select-none z-10">&times;</button>
        <h2 class="text-lg sm:text-xl font-bold mb-2 text-center text-secondary pr-6">Berita & Pengumuman Terbaru</h2>

        <!-- Carousel Container -->
        <div class="relative">
            <div id="carouselWrapper"
                class="flex overflow-hidden select-none transition-transform duration-300 ease-in-out">
                <!-- Slide 1: Berita dengan gambar -->
                <div class="min-w-full flex flex-col items-center justify-center" style="min-height: 180px;">
                    <h3 class="font-semibold mb-2 text-secondary text-center text-base">📰 Berita Terbaru</h3>
                    <div class="w-full rounded-lg border shadow-sm bg-white flex flex-col items-center p-3">
                        <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="judul berita"
                            class="w-full max-w-[150px] h-auto object-cover rounded-md mb-2">
                        <div class="font-bold text-sm sm:text-base mb-1 text-center text-secondary">Peluncuran Sistem
                            Informasi Terbaru PUSTIPD</div>
                        <div class="text-xs sm:text-sm text-secondary text-center leading-relaxed">Sistem informasi baru
                            telah diluncurkan untuk meningkatkan pelayanan digital.</div>
                    </div>
                </div>

                <!-- Slide 2: Berita tanpa gambar -->
                <div class="min-w-full flex flex-col items-center justify-center" style="min-height: 180px;">
                    <h3 class="font-semibold mb-2 text-secondary text-center text-base">📰 Berita Terbaru</h3>
                    <div class="w-full rounded-lg border shadow-sm bg-white p-3">
                        <div class="font-bold text-sm sm:text-base mb-1 text-center text-secondary">Workshop Digital
                            Transformation untuk UMKM</div>
                        <div class="text-xs sm:text-sm text-secondary text-center leading-relaxed">Pelatihan
                            komprehensif untuk meningkatkan kemampuan digital UMKM di era modern.</div>
                    </div>
                </div>

                <!-- Slide 3: Pengumuman (lebih compact) -->
                <div class="min-w-full flex flex-col items-center justify-center" style="min-height: 180px;">
                    <h3 class="font-semibold mb-2 text-secondary text-center text-base">📢 Pengumuman Penting</h3>
                    <div class="w-full rounded-lg border shadow-sm bg-orange-50 p-3 flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">!</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-sm text-secondary mb-1">Maintenance Server Terjadwal</div>
                            <div class="text-xs text-secondary">25 Juli 2025, 01:00 - 05:00 WIB</div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Pengumuman (lebih compact) -->
                <div class="min-w-full flex flex-col items-center justify-center" style="min-height: 180px;">
                    <h3 class="font-semibold mb-2 text-secondary text-center text-base">📢 Pengumuman Penting</h3>
                    <div class="w-full rounded-lg border shadow-sm bg-blue-50 p-3 flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">!</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-sm text-secondary mb-1">Program Magang Teknologi</div>
                            <div class="text-xs text-secondary">Kesempatan magang untuk mahasiswa IT durasi 3-6 bulan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons (tanpa circle, lebih kecil) -->
            <button id="prevBtn"
                class="absolute left-0 top-1/2 -translate-y-1/2  hover:text-custom-blue text-secondary p-1 transition-all duration-300 hover:scale-110">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextBtn"
                class="absolute right-0 top-1/2 -translate-y-1/2  hover:text-custom-blue text-secondary p-1 transition-all duration-300 hover:scale-110">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Carousel Indicators -->
            <div class="flex justify-center space-x-2 mt-3">
                <span
                    class="carousel-indicator w-2 h-2 rounded-full bg-secondary opacity-50 cursor-pointer transition-all duration-300"></span>
                <span
                    class="carousel-indicator w-2 h-2 rounded-full bg-secondary opacity-50 cursor-pointer transition-all duration-300"></span>
                <span
                    class="carousel-indicator w-2 h-2 rounded-full bg-secondary opacity-50 cursor-pointer transition-all duration-300"></span>
                <span
                    class="carousel-indicator w-2 h-2 rounded-full bg-secondary opacity-50 cursor-pointer transition-all duration-300"></span>
            </div>
        </div>
    </div>
</div>

<script>
    let autoInterval = null;
    let currentIndex = 0;

    // Show modal with animated entrance
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('newsAnnouncementModal');
        const modalWindow = document.getElementById('modalWindow');

        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            modalWindow.classList.remove('scale-95', 'translate-y-8');
            modalWindow.classList.add('scale-100', 'translate-y-0');

            // Initialize carousel after modal shows
            initializeCarousel();
        }, 500);
    });

    // Close modal function - langsung destroy
    function closeModal() {
        const modal = document.getElementById('newsAnnouncementModal');

        // Stop auto carousel
        if (autoInterval) {
            clearInterval(autoInterval);
            autoInterval = null;
        }

        // Remove modal completely from DOM
        if (modal) {
            modal.style.display = 'none';
            modal.remove();
        }
    }

    // Event listener untuk tombol close
    document.addEventListener('DOMContentLoaded', () => {
        const closeBtn = document.getElementById('closeModalBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        // Close modal when clicking outside
        const modal = document.getElementById('newsAnnouncementModal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        // Close modal with ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });

    // Carousel Logic
    function initializeCarousel() {
        const wrapper = document.getElementById('carouselWrapper');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.querySelectorAll('.carousel-indicator');

        if (!wrapper || !prevBtn || !nextBtn) return;

        const totalSlides = wrapper.children.length;

        function updateCarousel() {
            wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            indicators.forEach((el, idx) => {
                if (idx === currentIndex) {
                    el.classList.remove('opacity-50');
                    el.classList.add('opacity-100', 'bg-primary');
                    el.classList.remove('bg-secondary');
                } else {
                    el.classList.add('opacity-50', 'bg-secondary');
                    el.classList.remove('opacity-100', 'bg-primary');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function startAuto() {
            autoInterval = setInterval(nextSlide, 4000);
        }

        function stopAuto() {
            if (autoInterval) {
                clearInterval(autoInterval);
                autoInterval = null;
            }
        }

        function resetAuto() {
            stopAuto();
            startAuto();
        }

        // Event listeners dengan preventDefault
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            prevSlide();
            resetAuto();
        });

        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            nextSlide();
            resetAuto();
        });

        indicators.forEach((el, idx) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                currentIndex = idx;
                updateCarousel();
                resetAuto();
            });
        });

        // Pause auto-scroll on hover
        const modalWindow = document.getElementById('modalWindow');
        if (modalWindow) {
            modalWindow.addEventListener('mouseenter', stopAuto);
            modalWindow.addEventListener('mouseleave', startAuto);
        }

        // Initialize
        updateCarousel();
        startAuto();
    }
</script>
