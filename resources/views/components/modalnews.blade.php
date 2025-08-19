<!-- Modal Pop-up Pengumuman Penting -->
<div id="newsAnnouncementModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 transition-opacity duration-500 opacity-0 pointer-events-none px-2">
    <div id="modalWindow"
        class="bg-white rounded-xl shadow-2xl w-full max-w-md p-4 relative scale-95 translate-y-8 transition-all duration-500 max-h-[84vh] min-h-[340px] overflow-hidden">
        <button id="closeModalBtn"
            class="absolute top-2 right-2 text-secondary hover:text-red-600 text-xl font-bold leading-none select-none z-10">&times;</button>

        @if (isset($urgentAnnouncements) && $urgentAnnouncements->count() > 0)
            <h2 class="text-xl font-bold mb-2 text-center text-secondary">
                🚨 Pengumuman Penting PUSTIPD
            </h2>
            <div class="relative">
                <div id="carouselWrapper" class="flex transition-transform duration-300 ease-in-out"
                    style="height:320px;">

                    @foreach ($urgentAnnouncements as $announcement)
                        <div class="min-w-full flex flex-col items-center justify-start" style="height:320px;">
                            <!-- Header -->
                            <div class="w-full flex items-center mb-2 justify-between px-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-bold text-red-700">{{ $announcement->title }}</span>
                                </div>
                                <div class="text-xs text-gray-500 font-semibold">
                                    {{ \Carbon\Carbon::parse($announcement->publish_date ?? $announcement->date)->format('d M Y') }}
                                </div>
                            </div>
                            <!-- Kategori -->
                            <div class="w-full px-2 text-xs font-medium text-red-600 mb-1">
                                {{ ucfirst($announcement->category) }}
                            </div>
                            <!-- Excerpt Konten: hanya ringkasan -->
                            <div class="w-full h-full overflow-y-auto px-2 py-2">
                                <div
                                    class="text-sm text-gray-800 leading-relaxed bg-white rounded border border-red-100 p-2 max-h-[140px] overflow-hidden">
                                    {{ $announcement->excerpt ?: Str::limit(strip_tags($announcement->content), 400) }}
                                </div>
                                @if ($announcement->valid_until)
                                    <div
                                        class="text-xs text-red-700 bg-red-100 px-2 py-1 rounded mt-2 font-semibold flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Berlaku hingga:
                                        {{ \Carbon\Carbon::parse($announcement->valid_until)->format('d M Y, H:i') }}
                                        WIB
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Navigation Buttons: Selalu tampil -->
                <button id="prevBtn"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white border border-red-200 text-red-600 p-2 rounded-full shadow transition hover:scale-110 z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="nextBtn"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white border border-red-200 text-red-600 p-2 rounded-full shadow transition hover:scale-110 z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <!-- Carousel Indicators -->
                <div class="flex justify-center space-x-2 mt-3">
                    @for ($i = 0; $i < $urgentAnnouncements->count(); $i++)
                        <span
                            class="carousel-indicator w-3 h-3 rounded-full bg-red-300 opacity-50 cursor-pointer transition-all duration-300 hover:opacity-100"></span>
                    @endfor
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <div
                    class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 overflow-hidden bg-white shadow-lg border-2 border-blue-100">
                    <img src="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" alt="Logo UIN Raden Fatah Palembang"
                        class="w-12 h-12 object-contain">
                </div>
                <h2 class="text-lg sm:text-xl font-bold mb-2 text-secondary">
                    Selamat Datang di Website PUSTIPD
                </h2>
                <h3 class="text-base font-semibold text-custom-blue mb-2">
                    UIN Raden Fatah Palembang
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Pusat Sistem dan Teknologi Informasi dan Pangkalan Data<br>
                    Universitas Islam Negeri Raden Fatah Palembang
                </p>
                <div class="mt-4 text-xs text-gray-500">
                    {{ \Carbon\Carbon::now()->format('d F Y') }}
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    let autoInterval = null;
    let currentIndex = 0;
    const totalSlides = {{ isset($urgentAnnouncements) ? $urgentAnnouncements->count() : 0 }};

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('newsAnnouncementModal');
        const modalWindow = document.getElementById('modalWindow');
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            modalWindow.classList.remove('scale-95', 'translate-y-8');
            modalWindow.classList.add('scale-100', 'translate-y-0');
            if (totalSlides > 0) {
                initializeCarousel();
            }
        }, 800);
    });

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
                modal.style.display = 'none';
                modal.remove();
            }, 500);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const closeBtn = document.getElementById('closeModalBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }
        const modal = document.getElementById('newsAnnouncementModal');
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

    function initializeCarousel() {
        const wrapper = document.getElementById('carouselWrapper');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.querySelectorAll('.carousel-indicator');
        if (!wrapper || !prevBtn || !nextBtn) return;

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
            autoInterval = setInterval(nextSlide, 6000);
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

        const modalWindow = document.getElementById('modalWindow');
        if (modalWindow) {
            modalWindow.addEventListener('mouseenter', stopAuto);
            modalWindow.addEventListener('mouseleave', startAuto);
        }

        updateCarousel();
        startAuto();
    }
</script>
