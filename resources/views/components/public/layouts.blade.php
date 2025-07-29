<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUSTIPD | {{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

        <!-- SEO Meta Tags -->
        <meta name="description" content="{{ $description }}">
        <meta name="keywords" content="{{ $keywords }}">

        <!-- Font -->

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!-- JS -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>

    <body>
        <div class="flex flex-col min-h-screen">
            {{-- Isi Halaman --}}
            <!-- Navbar -->
            <x-public.navbar></x-public.navbar>
            <!-- Main -->
            <main class="flex-grow">
                {{-- <x-public.header>{{ $title }}</x-public.header> --}}
                {{ $slot }}
            </main>
            <!-- Footer -->
            <x-public.footer></x-public.footer>
        </div>

        <!-- =============================== -->
        <!-- Script Section -->
        <!-- =============================== -->

        <!-- Navbar Scroll Color Change + Clock -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ===============================
                // Navbar Color Change on Scroll
                // ===============================
                const navbar = document.getElementById('navbar');
                const navbarTitle = document.getElementById('navbar-title');
                const navLinks = navbar.querySelectorAll('a');
                const topbar = document.getElementById('topbar');
                const isHome = window.location.pathname === '/';
                const navbarMenus = document.querySelectorAll('.navbar-menu');

                if (!isHome) {
                    // Jika bukan home, navbar langsung putih + text biru + topbar hidden
                    topbar.classList.add('hidden');

                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-white');

                    navbarTitle.classList.remove('text-white');
                    navbarTitle.classList.add('text-[#062749]');

                    navbarMenus.forEach(item => {
                        item.classList.remove('text-white', 'text-[#062749]');
                        item.classList.add('text-secondary');
                    });

                    navLinks.forEach(link => {
                        link.classList.remove('text-white');
                        link.classList.add('text-[#062749]');
                    });
                }

                window.addEventListener('scroll', function() {
                    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (window.scrollY > 50) {
                        topbar.classList.add('hidden');

                        if (!isHome) {
                            // PAGE LAIN
                            navbar.classList.remove('bg-transparent', 'bg-gray-900');
                            navbar.classList.add('bg-white');

                            navbarTitle.classList.remove('text-white');
                            navbarTitle.classList.add('text-secondary');

                            navbarMenus.forEach(item => {
                                item.classList.remove('text-white', 'text-[#062749]');
                                item.classList.add('text-secondary');
                            });

                            navLinks.forEach(link => {
                                link.classList.remove('text-white');
                                link.classList.add('text-secondary');
                            });
                        } else {
                            // HOME
                            navbar.classList.remove('bg-transparent');
                            navbar.classList.add(isDark ? 'bg-gray-900' : 'bg-white');

                            if (isDark) {
                                // Navbar gelap: semua teks putih
                                navbarTitle.classList.remove('text-[#062749]', 'text-secondary');
                                navbarTitle.classList.add('text-white');

                                navbarMenus.forEach(item => {
                                    item.classList.remove('text-[#062749]', 'text-secondary');
                                    item.classList.add('text-white');
                                });

                                navLinks.forEach(link => {
                                    link.classList.remove('text-[#062749]', 'text-secondary');
                                    link.classList.add('text-white');
                                });
                            } else {
                                // Navbar putih: semua teks secondary/biru
                                navbarTitle.classList.remove('text-white');
                                navbarTitle.classList.add('text-secondary');

                                navbarMenus.forEach(item => {
                                    item.classList.remove('text-white');
                                    item.classList.add('text-secondary');
                                });

                                navLinks.forEach(link => {
                                    link.classList.remove('text-white');
                                    link.classList.add('text-secondary');
                                });
                            }
                        }

                    } else {
                        if (isHome) {
                            // HOME SCROLL UP
                            topbar.classList.remove('hidden');

                            navbar.classList.remove('bg-white', 'bg-gray-900');
                            navbar.classList.add('bg-transparent');

                            // Saat transparan: selalu teks putih
                            navbarTitle.classList.remove('text-[#062749]', 'text-secondary');
                            navbarTitle.classList.add('text-white');

                            navbarMenus.forEach(item => {
                                item.classList.remove('text-[#062749]', 'text-secondary');
                                item.classList.add('text-white');
                            });

                            navLinks.forEach(link => {
                                link.classList.remove('text-[#062749]', 'text-secondary');
                                link.classList.add('text-white');
                            });
                        } else {
                            // PAGE LAIN SCROLL UP → tetap putih + text secondary
                            topbar.classList.add('hidden');

                            navbar.classList.remove('bg-transparent', 'bg-gray-900');
                            navbar.classList.add('bg-white');

                            navbarTitle.classList.remove('text-white');
                            navbarTitle.classList.add('text-secondary');

                            navbarMenus.forEach(item => {
                                item.classList.remove('text-white');
                                item.classList.add('text-secondary');
                            });

                            navLinks.forEach(link => {
                                link.classList.remove('text-white');
                                link.classList.add('text-secondary');
                            });
                        }
                    }
                });

                // ===============================
                // Update Clock & Open Status
                // ===============================
                const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

                function updateClock() {
                    const now = new Date();
                    const jakarta = new Date(now.toLocaleString("en-US", {
                        timeZone: "Asia/Jakarta"
                    }));

                    const dayIdx = jakarta.getDay();
                    const hr = jakarta.getHours();
                    const min = jakarta.getMinutes();
                    const isOpen = dayIdx >= 1 && dayIdx <= 5 && hr >= 8 && (hr < 16 || (hr === 16 && min === 0));

                    document.getElementById("open-status").textContent = isOpen ? "BUKA :" : "TUTUP :";
                    document.getElementById("clock").textContent =
                        ` ${days[dayIdx]}, ${jakarta.getDate().toString().padStart(2, "0")} ${months[jakarta.getMonth()]} ${jakarta.getFullYear()} (${hr.toString().padStart(2, "0")}.${min.toString().padStart(2, "0")} WIB)`;
                }

                updateClock();
                setInterval(updateClock, 60000); // per menit

                // ===============================
                // klik on Gallery Cards
                // ===============================
                const galleryCards = document.querySelectorAll('.gallery-card');
                const popup = document.getElementById('gallery-popup');
                const popupImg = document.getElementById('popup-img');
                const popupCaption = document.getElementById('popup-caption');
                const closeBtn = document.getElementById('popup-close');

                galleryCards.forEach(card => {
                    card.addEventListener('click', function() {
                        const idx = Number(card.dataset.idx);
                        popupImg.src = gallery[idx].image;
                        popupCaption.textContent = gallery[idx].caption;
                        popup.classList.add('active');
                        popup.focus();
                    });
                });

                closeBtn.addEventListener('click', function() {
                    popup.classList.remove('active');
                });

                popup.addEventListener('click', function(e) {
                    if (e.target === popup) popup.classList.remove('active');
                });

                window.addEventListener('keydown', function(e) {
                    if (popup.classList.contains('active') && e.key === 'Escape') {
                        popup.classList.remove('active');
                    }
                });
            });
        </script>

        <!-- Universal Carousel -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                class UniversalCarousel {
                    constructor(config) {
                        // Config
                        Object.assign(this, {
                            maxIndicators: 5,
                            indicatorActiveClass: 'bg-secondary',
                            indicatorInactiveClass: 'bg-gray-300',
                            indicatorHoverClass: 'hover:bg-gray-400',
                            autoPlayDelay: 4000,
                            ...config
                        });

                        // DOM
                        this.carousel = document.getElementById(this.carouselId);
                        this.wrapper = document.getElementById(this.wrapperId);
                        this.prevBtn = document.getElementById(this.prevBtnId);
                        this.nextBtn = document.getElementById(this.nextBtnId);
                        this.indicatorsContainer = document.getElementById(this.indicatorsId);
                        this.progressBar = document.getElementById(this.progressBarId);

                        if (!this.carousel || !this.wrapper) return;

                        this.slides = this.wrapper.querySelectorAll('.carousel-slide');
                        this.totalSlides = this.slides.length;
                        this.currentIndex = 0;
                        this.slidesToShow = this.getSlidesToShow();
                        this.maxIndex = Math.max(0, this.totalSlides - this.slidesToShow);
                        this.autoPlayInterval = null;
                        this.isTransitioning = false;

                        this.init();
                    }

                    getSlidesToShow() {
                        const width = window.innerWidth;
                        if (width >= 1024) return 3;
                        if (width >= 768) return 2;
                        return 1;
                    }

                    init() {
                        this.createIndicators();
                        this.updateCarousel();
                        this.bindEvents();
                        this.startAutoPlay();
                        window.addEventListener('resize', () => this.handleResize());
                    }

                    createIndicators() {
                        this.indicatorsContainer.innerHTML = '';
                        const totalIndicators = this.maxIndex + 1;
                        const count = Math.min(totalIndicators, this.maxIndicators);

                        for (let i = 0; i < count; i++) {
                            const btn = document.createElement('button');
                            btn.className =
                                `w-3 h-3 rounded-full transition-all duration-300 ${this.getIndicatorClass(i)}`;
                            btn.addEventListener('click', () => this.goToMappedSlide(i, count, totalIndicators));
                            this.indicatorsContainer.appendChild(btn);
                        }
                    }

                    goToMappedSlide(i, count, total) {
                        const ratio = (total - 1) / (count - 1);
                        const target = total <= this.maxIndicators ? i : Math.round(i * ratio);
                        this.goToSlide(target);
                    }

                    getIndicatorClass(i) {
                        const total = this.maxIndex + 1;
                        const count = Math.min(total, this.maxIndicators);
                        const ratio = (total - 1) / (count - 1);
                        const mapped = Math.round(this.currentIndex / ratio);
                        return (total <= this.maxIndicators ? i === this.currentIndex : i === mapped) ?
                            `${this.indicatorActiveClass} scale-110` :
                            `${this.indicatorInactiveClass} ${this.indicatorHoverClass}`;
                    }

                    updateCarousel() {
                        if (this.isTransitioning) return;

                        this.wrapper.style.transform =
                            `translateX(-${this.currentIndex * (100 / this.slidesToShow)}%)`;

                        // Update indicators
                        [...this.indicatorsContainer.children].forEach((btn, i) => {
                            btn.className =
                                `w-3 h-3 rounded-full transition-all duration-300 ${this.getIndicatorClass(i)}`;
                        });

                        if (this.progressBar) {
                            const progress = ((this.currentIndex + 1) / (this.maxIndex + 1)) * 100;
                            this.progressBar.style.width = `${progress}%`;
                        }

                        if (this.prevBtn) this.prevBtn.disabled = this.currentIndex === 0;
                        if (this.nextBtn) this.nextBtn.disabled = this.currentIndex === this.maxIndex;

                        this.slides.forEach((slide, i) => {
                            const card = slide.querySelector('.group');
                            if (card) {
                                const visible = i >= this.currentIndex && i < this.currentIndex + this
                                    .slidesToShow;
                                card.style.opacity = visible ? '1' : '0.7';
                                card.style.transform = visible ? 'translateY(0)' : 'translateY(10px)';
                            }
                        });
                    }

                    nextSlide() {
                        if (this.currentIndex < this.maxIndex && !this.isTransitioning) {
                            this.transition(() => this.currentIndex++);
                        }
                    }

                    prevSlide() {
                        if (this.currentIndex > 0 && !this.isTransitioning) {
                            this.transition(() => this.currentIndex--);
                        }
                    }

                    goToSlide(i) {
                        if (i !== this.currentIndex && !this.isTransitioning) {
                            this.transition(() => this.currentIndex = i);
                        }
                    }

                    transition(fn) {
                        this.isTransitioning = true;
                        fn();
                        this.updateCarousel();
                        this.resetAutoPlay();
                        setTimeout(() => this.isTransitioning = false, 500);
                    }

                    startAutoPlay() {
                        this.autoPlayInterval = setInterval(() => {
                            this.currentIndex = (this.currentIndex === this.maxIndex) ? 0 : this
                                .currentIndex + 1;
                            this.updateCarousel();
                        }, this.autoPlayDelay);
                    }

                    stopAutoPlay() {
                        clearInterval(this.autoPlayInterval);
                        this.autoPlayInterval = null;
                    }

                    resetAutoPlay() {
                        this.stopAutoPlay();
                        this.startAutoPlay();
                    }

                    handleResize() {
                        const newSlides = this.getSlidesToShow();
                        if (newSlides !== this.slidesToShow) {
                            this.slidesToShow = newSlides;
                            this.maxIndex = Math.max(0, this.totalSlides - newSlides);
                            this.currentIndex = Math.min(this.currentIndex, this.maxIndex);
                            this.createIndicators();
                            this.updateCarousel();
                        }
                    }

                    bindEvents() {
                        if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                        if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());

                        this.carousel.addEventListener('mouseenter', () => this.stopAutoPlay());
                        this.carousel.addEventListener('mouseleave', () => this.startAutoPlay());

                        let startX = 0,
                            startY = 0;

                        this.carousel.addEventListener('touchstart', e => {
                            startX = e.changedTouches[0].pageX;
                            startY = e.changedTouches[0].pageY;
                        });

                        this.carousel.addEventListener('touchmove', e => e.preventDefault());

                        this.carousel.addEventListener('touchend', e => {
                            const distX = e.changedTouches[0].pageX - startX;
                            const distY = e.changedTouches[0].pageY - startY;

                            if (Math.abs(distX) > 50 && Math.abs(distX) > Math.abs(distY)) {
                                distX > 0 ? this.prevSlide() : this.nextSlide();
                            }
                        });

                        document.addEventListener('keydown', e => {
                            if (e.key === 'ArrowLeft') this.prevSlide();
                            if (e.key === 'ArrowRight') this.nextSlide();
                        });
                    }
                }

                // Inisialisasi carousel
                new UniversalCarousel({
                    carouselId: 'servicesCarousel',
                    wrapperId: 'carouselWrapper',
                    prevBtnId: 'prevBtn',
                    nextBtnId: 'nextBtn',
                    indicatorsId: 'indicators',
                    progressBarId: 'progressBar',
                    indicatorActiveClass: 'bg-secondary',
                    indicatorInactiveClass: 'bg-custom-blue',
                    indicatorHoverClass: 'hover:bg-white',
                    autoPlayDelay: 4000
                });

                new UniversalCarousel({
                    carouselId: 'partnersCarousel',
                    wrapperId: 'partnersWrapper',
                    prevBtnId: 'partnersPrevBtn',
                    nextBtnId: 'partnersNextBtn',
                    indicatorsId: 'partnersIndicators',
                    progressBarId: 'partnersProgressBar',
                    indicatorActiveClass: 'bg-secondary',
                    indicatorInactiveClass: 'bg-custom-blue',
                    indicatorHoverClass: 'hover:bg-white',
                    autoPlayDelay: 3500
                });
            });
        </script>

        <!-- Scroll Animation & Parallax -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                document.querySelectorAll('.news-card').forEach(card => observer.observe(card));

                // Parallax effect
                window.addEventListener('scroll', () => {
                    const berita = document.getElementById('berita');
                    if (berita) {
                        berita.style.transform = `translateY(${window.pageYOffset * -0.5}px)`;
                    }
                });

                // Stagger card animation
                setTimeout(() => {
                    document.querySelectorAll('.news-card').forEach((card, i) => {
                        card.style.animationDelay = `${i * 0.1}s`;
                        card.classList.add('animate');
                    });
                }, 500);
            });
        </script>

        <!-- Team Carousel Auto Pause -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carousel = document.getElementById('teamCarousel');
                if (!carousel) return;

                carousel.addEventListener('mouseenter', () => carousel.style.animationPlayState = 'paused');
                carousel.addEventListener('mouseleave', () => carousel.style.animationPlayState = 'running');

                document.addEventListener('visibilitychange', () => {
                    carousel.style.animationPlayState = document.hidden ? 'paused' : 'running';
                });
            });
        </script>

        <!-- #achievement-carousel -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                class AchievementCarousel {
                    constructor(element) {
                        this.element = element;
                        this.currentSlide = 0;
                        this.autoPlayDuration = parseInt(element.getAttribute('data-duration')) || 4000;
                        this.autoPlayInterval = null;
                        this.progressInterval = null;
                        this.progressWidth = 0;
                        this.isMobile = window.innerWidth < 1024;

                        // Set elements berdasarkan screen size
                        this.updateResponsiveElements();

                        this.progressBar = element.querySelector('.achievement-progress-bar');

                        this.init();

                        // Listen for resize events
                        window.addEventListener('resize', () => {
                            this.handleResize();
                        });
                    }

                    updateResponsiveElements() {
                        this.isMobile = window.innerWidth < 1024; // lg breakpoint

                        if (this.isMobile) {
                            // Mobile: 1 card per slide
                            this.totalSlides = parseInt(this.element.getAttribute('data-total-slides-mobile')) || 1;
                            this.carouselTrack = this.element.querySelector('.achievement-carousel-track-mobile');
                            this.indicators = this.element.querySelectorAll('.achievement-indicator-mobile');
                        } else {
                            // Desktop: 5 cards per slide
                            this.totalSlides = parseInt(this.element.getAttribute('data-total-slides-desktop')) ||
                                1;
                            this.carouselTrack = this.element.querySelector('.achievement-carousel-track-desktop');
                            this.indicators = this.element.querySelectorAll('.achievement-indicator-desktop');
                        }
                    }

                    handleResize() {
                        const wasMobile = this.isMobile;
                        const isMobile = window.innerWidth < 1024;

                        // Jika ada perubahan dari mobile ke desktop atau sebaliknya
                        if (wasMobile !== isMobile) {
                            this.stopAutoPlay();
                            this.currentSlide = 0;
                            this.updateResponsiveElements();
                            this.updateCarousel();
                            this.bindEvents(); // Re-bind events untuk indicators baru
                            this.startAutoPlay();
                        }
                    }

                    init() {
                        this.bindEvents();
                        this.startAutoPlay();
                        this.updateCarousel();
                    }

                    bindEvents() {
                        // Remove previous event listeners jika ada
                        this.indicators.forEach(indicator => {
                            indicator.replaceWith(indicator.cloneNode(true));
                        });

                        // Update indicators reference setelah clone
                        if (this.isMobile) {
                            this.indicators = this.element.querySelectorAll('.achievement-indicator-mobile');
                        } else {
                            this.indicators = this.element.querySelectorAll('.achievement-indicator-desktop');
                        }

                        // Bind new event listeners
                        this.indicators.forEach((indicator, index) => {
                            indicator.addEventListener('click', () => {
                                this.goToSlide(index);
                            });
                        });

                        // Pause on hover
                        this.element.addEventListener('mouseenter', () => {
                            this.stopAutoPlay();
                        });

                        this.element.addEventListener('mouseleave', () => {
                            this.startAutoPlay();
                        });

                        // Touch/Swipe support
                        let startX = 0;
                        let startY = 0;

                        this.element.addEventListener('touchstart', (e) => {
                            startX = e.changedTouches[0].pageX;
                            startY = e.changedTouches[0].pageY;
                        });

                        this.element.addEventListener('touchmove', (e) => {
                            e.preventDefault();
                        });

                        this.element.addEventListener('touchend', (e) => {
                            const distX = e.changedTouches[0].pageX - startX;
                            const distY = e.changedTouches[0].pageY - startY;

                            if (Math.abs(distX) > 50 && Math.abs(distX) > Math.abs(distY)) {
                                if (distX > 0) {
                                    this.prevSlide();
                                } else {
                                    this.nextSlide();
                                }
                            }
                        });
                    }

                    startAutoPlay() {
                        this.progressWidth = 0;

                        // Progress bar animation
                        if (this.progressBar) {
                            this.progressInterval = setInterval(() => {
                                this.progressWidth += (100 / (this.autoPlayDuration / 100));
                                if (this.progressWidth >= 100) {
                                    this.progressWidth = 0;
                                }
                                this.progressBar.style.width = `${this.progressWidth}%`;
                            }, 100);
                        }

                        // Auto slide change
                        this.autoPlayInterval = setInterval(() => {
                            this.nextSlide();
                        }, this.autoPlayDuration);
                    }

                    stopAutoPlay() {
                        if (this.autoPlayInterval) {
                            clearInterval(this.autoPlayInterval);
                            this.autoPlayInterval = null;
                        }
                        if (this.progressInterval) {
                            clearInterval(this.progressInterval);
                            this.progressInterval = null;
                        }
                    }

                    nextSlide() {
                        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                        this.progressWidth = 0;
                        this.updateCarousel();
                    }

                    prevSlide() {
                        this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                        this.progressWidth = 0;
                        this.updateCarousel();
                    }

                    goToSlide(index) {
                        this.currentSlide = index;
                        this.stopAutoPlay();
                        this.progressWidth = 0;
                        this.updateCarousel();

                        // Restart autoplay after 3 seconds
                        setTimeout(() => {
                            this.startAutoPlay();
                        }, 3000);
                    }

                    updateCarousel() {
                        // Update carousel track position
                        if (this.carouselTrack) {
                            this.carouselTrack.style.transform = `translateX(-${this.currentSlide * 100}%)`;
                        }

                        // Update indicators (hanya yang aktif)
                        this.indicators.forEach((indicator, index) => {
                            if (index === this.currentSlide) {
                                indicator.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                                indicator.classList.add('bg-secondary', 'shadow-md', 'scale-110');
                            } else {
                                indicator.classList.remove('bg-secondary', 'shadow-md', 'scale-110');
                                indicator.classList.add('bg-gray-300', 'hover:bg-gray-400');
                            }
                        });

                        // Update progress bar
                        if (this.progressBar) {
                            this.progressBar.style.width = `${this.progressWidth}%`;
                        }
                    }

                    // Public methods for external control
                    pause() {
                        this.stopAutoPlay();
                    }

                    resume() {
                        this.startAutoPlay();
                    }

                    destroy() {
                        this.stopAutoPlay();
                        // Remove event listeners if needed
                        window.removeEventListener('resize', this.handleResize);
                    }
                }

                // Initialize all achievement carousels
                function initAchievementCarousels() {
                    const carousels = document.querySelectorAll('.achievement-carousel');
                    carousels.forEach(carousel => {
                        new AchievementCarousel(carousel);
                    });
                }

                // Initialize on DOM ready
                initAchievementCarousels();

                // Make it available globally if needed
                window.AchievementCarousel = AchievementCarousel;
                window.initAchievementCarousels = initAchievementCarousels;
            });
        </script>

    </body>

</html>
