<!-- Modal Pop-up Pengumuman Penting -->
<div id="newsAnnouncementModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/10 backdrop-blur-sm transition-opacity duration-500 opacity-0 pointer-events-none px-4">

    <div class="relative flex items-center justify-center w-full">
        <!-- Modal Window -->
        <div id="modalWindow"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-0 relative scale-95 translate-y-8 transition-all duration-500 overflow-hidden">

            <button id="closeModalBtn"
                class="absolute top-4 right-4 text-gray-400 hover:text-red-600 text-2xl font-bold leading-none select-none z-20 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-all duration-200">&times;</button>

            @if (isset($urgentAnnouncements) && $urgentAnnouncements->count() > 0)
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 pb-2relative">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="animate-pulse">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-center">
                            Pengumuman Penting PUSTIPD
                        </h2>
                    </div>
                    <!-- Decorative wave -->
                    <div class="absolute bottom-0 left-0 right-0 h-3 bg-white rounded-t-3xl"></div>
                </div>

                <!-- Content Area yang fleksibel -->
                <div class="relative min-h-[300px]">
                    <div id="carouselWrapper" class="flex transition-transform duration-200 ease-in-out">
                        @foreach ($urgentAnnouncements as $announcement)
                            <div class="min-w-full flex flex-col px-6 py-4">
                                <!-- Header pengumuman -->
                                <div class="flex items-start mb-4 gap-3">
                                    <div
                                        class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-800 text-lg leading-tight mb-2">
                                            {{ $announcement->title }}
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                                            <span
                                                class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                                {{ ucfirst($announcement->category) }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($announcement->publish_date ?? $announcement->date)->format('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content pengumuman -->
                                <div class="flex-1 mb-4">
                                    <div
                                        class="text-gray-700 leading-relaxed bg-gray-50 rounded-xl border border-gray-200 p-4">
                                        <div class="text-base">
                                            {{ $announcement->excerpt ?: Str::limit(strip_tags($announcement->content), 200) }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Valid until dengan styling yang lebih besar -->
                                @if ($announcement->valid_until)
                                    <div
                                        class="bg-gradient-to-r from-orange-50 to-red-50 border-l-4 border-red-500 rounded-r-lg p-2 mb-2">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-red-800 font-semibold text-base">Berlaku hingga:</h4>
                                                <p class="text-red-700 font-bold text-lg">
                                                    {{ \Carbon\Carbon::parse($announcement->valid_until)->format('d F Y, H:i') }}
                                                    WIB
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Spacer untuk memastikan indicators tidak overlap -->
                                <div class="h-8"></div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Indicators -->
                    @if ($urgentAnnouncements->count() > 1)
                        <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2 z-10 pb-4">
                            @for ($i = 0; $i < $urgentAnnouncements->count(); $i++)
                                <span
                                    class="carousel-indicator w-3 h-3 rounded-full bg-red-300 opacity-50 cursor-pointer transition-all duration-200 hover:opacity-100 hover:scale-110"></span>
                            @endfor
                        </div>
                    @endif
                </div>
            @else
                <!-- Welcome screen dengan sizing yang lebih fleksibel -->
                <div class="flex flex-col items-center justify-center py-8 px-6">
                    <div
                        class="w-20 h-20 rounded-full flex items-center justify-center mb-6 overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg border-2 border-blue-200">
                        <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="Logo UIN Raden Fatah Palembang"
                            class="w-14 h-14 object-contain">
                    </div>
                    <h2 class="text-2xl font-bold mb-3 text-gray-800 text-center">
                        Selamat Datang di Website PUSTIPD
                    </h2>
                    <h3 class="text-lg font-semibold text-blue-600 mb-4 text-center">
                        UIN Raden Fatah Palembang
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-center max-w-md">
                        Pusat Sistem dan Teknologi Informasi dan Pangkalan Data<br>
                        Universitas Islam Negeri Raden Fatah Palembang
                    </p>
                    <div class="text-sm text-gray-500 mt-4 bg-gray-50 px-4 py-2 rounded-full">
                        {{ \Carbon\Carbon::now()->format('d F Y') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    let autoInterval = null;
    let currentIndex = 0;
    const totalSlides = {{ isset($urgentAnnouncements) ? $urgentAnnouncements->count() : 0 }};

    // Show modal dengan animated entrance
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('newsAnnouncementModal');
        const modalWindow = document.getElementById('modalWindow');

        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            modalWindow.classList.remove('scale-95', 'translate-y-8');
            modalWindow.classList.add('scale-100', 'translate-y-0');

            // Initialize carousel setelah modal muncul
            if (totalSlides > 0) {
                initializeCarousel();
            }
        }, 700);
    });

    // Close modal function
    function closeModal() {
        const modal = document.getElementById('newsAnnouncementModal');
        if (autoInterval) {
            clearInterval(autoInterval);
            autoInterval = null;
        }
        if (modal) {
            const modalWindow = document.getElementById('modalWindow');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modalWindow.classList.remove('scale-100', 'translate-y-0');
            modalWindow.classList.add('scale-95', 'translate-y-8');
            setTimeout(() => {
                modal.remove();
            }, 450);
        }
    }

    // Event listeners untuk close modal
    document.addEventListener('DOMContentLoaded', () => {
        const closeBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('newsAnnouncementModal');

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });

    // Carousel Logic
    function initializeCarousel() {
        const wrapper = document.getElementById('carouselWrapper');
        const indicators = document.querySelectorAll('.carousel-indicator');

        if (!wrapper) return;

        function updateCarousel() {
            wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            indicators.forEach((el, idx) => {
                if (idx === currentIndex) {
                    el.classList.remove('opacity-50', 'bg-red-300');
                    el.classList.add('opacity-100', 'bg-red-600');
                } else {
                    el.classList.add('opacity-50', 'bg-red-300');
                    el.classList.remove('opacity-100', 'bg-red-600');
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
            if (totalSlides > 1) {
                autoInterval = setInterval(nextSlide, 7000); // Slightly longer for better reading
            }
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

        // Event listeners untuk indicators
        indicators.forEach((el, idx) => {
            el.addEventListener('click', function(e) {
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

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (totalSlides > 1) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                const wrapper = document.getElementById('carouselWrapper');
                if (wrapper) {
                    wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
                    const indicators = document.querySelectorAll('.carousel-indicator');
                    indicators.forEach((el, idx) => {
                        if (idx === currentIndex) {
                            el.classList.remove('opacity-50', 'bg-red-300');
                            el.classList.add('opacity-100', 'bg-red-600');
                        } else {
                            el.classList.add('opacity-50', 'bg-red-300');
                            el.classList.remove('opacity-100', 'bg-red-600');
                        }
                    });
                }
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                currentIndex = (currentIndex + 1) % totalSlides;
                const wrapper = document.getElementById('carouselWrapper');
                if (wrapper) {
                    wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
                    const indicators = document.querySelectorAll('.carousel-indicator');
                    indicators.forEach((el, idx) => {
                        if (idx === currentIndex) {
                            el.classList.remove('opacity-50', 'bg-red-300');
                            el.classList.add('opacity-100', 'bg-red-600');
                        } else {
                            el.classList.add('opacity-50', 'bg-red-300');
                            el.classList.remove('opacity-100', 'bg-red-600');
                        }
                    });
                }
            }
        }
    });
</script>
