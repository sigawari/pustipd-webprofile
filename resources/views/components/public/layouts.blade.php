<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>PUSTIPD | {{ $title }}</title>
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

        <!-- SEO Meta Tags -->
        <meta name="description" content="{{ $description }}">
        <meta name="keywords" content="{{ $keywords }}">

        <!-- Font -->

        <!-- CSS -->


        <!-- JS -->


    </head>

    <body>
        <div class="flex flex-col min-h-screen bg-blue-950">
            {{-- Isi Halaman --}}
            <!-- Navbar -->
            <x-public.navbar></x-public.navbar>
            <!-- Main -->
            <main class="flex-grow">
                <!-- <x-public.header>{{ $title }}</x-public.header> Pindah ke tiap pages aja atau disesuaikan -->
                {{ $slot }}
            </main>
            <!-- Footer -->
            <x-public.footer></x-public.footer>
        </div>
        <!-- =============================== -->
        <!-- Script Section -->
        <!-- =============================== -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ===============================
                // Script Navbar Color Change on Scroll
                // ===============================
                const navbar = document.getElementById('navbar');
                const navbarTitle = document.getElementById('navbar-title');
                const navLinks = navbar.querySelectorAll('a');
                const topbar = document.getElementById('topbar');

                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        // Hide Upper Navbar
                        topbar.classList.add('hidden');

                        // Change Navbar Color
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            navbar.classList.remove('bg-transparent');
                            navbar.classList.add('bg-gray-900');

                            navbarTitle.classList.remove('text-[#062749]');
                            navbarTitle.classList.add('text-white');

                            navLinks.forEach(link => {
                                link.classList.remove('text-[#062749]');
                                link.classList.add('text-white');
                            });

                        } else {
                            navbar.classList.remove('bg-transparent');
                            navbar.classList.add('bg-white');

                            navbarTitle.classList.remove('text-white');
                            navbarTitle.classList.add('text-[#062749]');

                            navLinks.forEach(link => {
                                link.classList.remove('text-white');
                                link.classList.add('text-[#062749]');
                            });
                        }
                    } else {
                        // Show Upper Navbar
                        topbar.classList.remove('hidden');

                        navbar.classList.remove('bg-white', 'bg-gray-900');
                        navbar.classList.add('bg-transparent');

                        navbarTitle.classList.remove('text-[#062749]');
                        navbarTitle.classList.add('text-white');

                        navLinks.forEach(link => {
                            link.classList.remove('text-[#062749]');
                            link.classList.add('text-white');
                        });
                    }
                });

                // ===============================
                // Script Update Clock & Status Open
                // ===============================
                const days = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
                const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

                function updateClock() {
                    const now = new Date();
                    const jakarta = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));

                    const dayIdx = jakarta.getDay();
                    const hr = jakarta.getHours();
                    const min = jakarta.getMinutes();

                    const isOpen = dayIdx >= 1 && dayIdx <= 5 && hr >= 8 && (hr < 16 || (hr === 16 && min === 0));

                    const status = isOpen ? "BUKA :" : "TUTUP :";
                    const dayName = days[dayIdx];
                    const day = jakarta.getDate().toString().padStart(2, "0");
                    const month = months[jakarta.getMonth()];
                    const year = jakarta.getFullYear();
                    const time = `${hr.toString().padStart(2, "0")}.${min.toString().padStart(2, "0")} WIB`;

                    document.getElementById("open-status").textContent = status;
                    document.getElementById("clock").textContent = ` ${dayName}, ${day} ${month} ${year} (${time})`;
                }

                updateClock(); // initial
                setInterval(updateClock, 60_000); // update every minute
            });

            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================
            // ===============================
            // Script For
            // ===============================

        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                class UniversalCarousel {
                    constructor(config) {
                        // Configuration
                        this.maxIndicators = config.maxIndicators || 5;
                        this.carouselId = config.carouselId;
                        this.wrapperId = config.wrapperId;
                        this.prevBtnId = config.prevBtnId;
                        this.nextBtnId = config.nextBtnId;
                        this.indicatorsId = config.indicatorsId;
                        this.progressBarId = config.progressBarId;
                        this.indicatorActiveClass = config.indicatorActiveClass || 'bg-secondary';
                        this.indicatorInactiveClass = config.indicatorInactiveClass || 'bg-gray-300';
                        this.indicatorHoverClass = config.indicatorHoverClass || 'hover:bg-gray-400';

                        // DOM Elements
                        this.carousel = document.getElementById(this.carouselId);
                        this.wrapper = document.getElementById(this.wrapperId);
                        this.prevBtn = document.getElementById(this.prevBtnId);
                        this.nextBtn = document.getElementById(this.nextBtnId);
                        this.indicatorsContainer = document.getElementById(this.indicatorsId);
                        this.progressBar = document.getElementById(this.progressBarId);

                        if (!this.carousel || !this.wrapper) return;

                        // Carousel State
                        this.slides = this.wrapper.querySelectorAll('.carousel-slide');
                        this.totalSlides = this.slides.length;
                        this.currentIndex = 0;
                        this.slidesToShow = this.getSlidesToShow();
                        this.maxIndex = Math.max(0, this.totalSlides - this.slidesToShow);
                        this.autoPlayInterval = null;
                        this.autoPlayDelay = config.autoPlayDelay || 4000;
                        this.isTransitioning = false;

                        this.init();
                    }

                    getSlidesToShow() {
                        const width = window.innerWidth;
                        if (width >= 1024) return 3; // lg: 3 slides
                        if (width >= 768) return 2; // md: 2 slides
                        return 1; // mobile: 1 slide
                    }

                    init() {
                        this.createIndicators();
                        this.updateCarousel();
                        this.bindEvents();
                        this.startAutoPlay();

                        // Handle window resize
                        window.addEventListener('resize', () => {
                            this.handleResize();
                        });
                    }

                    createIndicators() {
                        this.indicatorsContainer.innerHTML = '';

                        // Hitung total indikator yang dibutuhkan
                        const totalPossibleIndicators = this.maxIndex + 1;

                        // Batasi indikator maksimal 5
                        const indicatorsToShow = Math.min(totalPossibleIndicators, this.maxIndicators);

                        // Buat indikator sesuai batas maksimal
                        for (let i = 0; i < indicatorsToShow; i++) {
                            const indicator = document.createElement('button');
                            indicator.className = `w-3 h-3 rounded-full transition-all duration-300 ${
                this.getIndicatorClass(i)
            }`;

                            // Event listener dengan logic mapping
                            indicator.addEventListener('click', () => this.goToMappedSlide(i, indicatorsToShow,
                                totalPossibleIndicators));
                            this.indicatorsContainer.appendChild(indicator);
                        }
                    }

                    // Method baru untuk mapping indikator ke slide
                    goToMappedSlide(indicatorIndex, indicatorsToShow, totalPossibleIndicators) {
                        let targetSlide;

                        if (totalPossibleIndicators <= this.maxIndicators) {
                            // Jika total indikator <= 5, mapping langsung
                            targetSlide = indicatorIndex;
                        } else {
                            // Jika total indikator > 5, bagi secara proporsional
                            const ratio = (totalPossibleIndicators - 1) / (indicatorsToShow - 1);
                            targetSlide = Math.round(indicatorIndex * ratio);
                        }

                        this.goToSlide(targetSlide);
                    }

                    // Method yang diperbaiki untuk indikator aktif tunggal
                    getIndicatorClass(indicatorIndex) {
                        const totalPossibleIndicators = this.maxIndex + 1;
                        const indicatorsToShow = Math.min(totalPossibleIndicators, this.maxIndicators);

                        let isActive = false;

                        if (totalPossibleIndicators <= this.maxIndicators) {
                            // Mapping langsung
                            isActive = indicatorIndex === this.currentIndex;
                        } else {
                            // Mapping proporsional dengan logic yang lebih ketat
                            const ratio = (totalPossibleIndicators - 1) / (indicatorsToShow - 1);
                            const mappedIndex = Math.round(indicatorIndex * ratio);

                            // PERBAIKAN: Hanya satu indikator yang aktif
                            isActive = Math.round(this.currentIndex / ratio) === indicatorIndex;
                        }

                        return isActive ?
                            `${this.indicatorActiveClass} scale-110` :
                            `${this.indicatorInactiveClass} ${this.indicatorHoverClass}`;
                    }

                    updateCarousel() {
                        if (this.isTransitioning) return;

                        const translateX = -(this.currentIndex * (100 / this.slidesToShow));
                        this.wrapper.style.transform = `translateX(${translateX}%)`;

                        // Update indicators dengan logic baru
                        const indicators = this.indicatorsContainer.querySelectorAll('button');
                        indicators.forEach((indicator, index) => {
                            indicator.className = `w-3 h-3 rounded-full transition-all duration-300 ${
                this.getIndicatorClass(index)
            }`;
                        });

                        // Update progress bar
                        const progress = ((this.currentIndex + 1) / (this.maxIndex + 1)) * 100;
                        if (this.progressBar) {
                            this.progressBar.style.width = `${progress}%`;
                        }

                        // Update navigation buttons
                        if (this.prevBtn) this.prevBtn.disabled = this.currentIndex === 0;
                        if (this.nextBtn) this.nextBtn.disabled = this.currentIndex === this.maxIndex;

                        // Animation untuk cards
                        this.slides.forEach((slide, index) => {
                            const card = slide.querySelector('.group');
                            if (card) {
                                if (index >= this.currentIndex && index < this.currentIndex + this
                                    .slidesToShow) {
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0)';
                                } else {
                                    card.style.opacity = '0.7';
                                    card.style.transform = 'translateY(10px)';
                                }
                            }
                        });
                    }

                    nextSlide() {
                        if (this.currentIndex < this.maxIndex && !this.isTransitioning) {
                            this.isTransitioning = true;
                            this.currentIndex++;
                            this.updateCarousel();
                            this.resetAutoPlay();

                            setTimeout(() => {
                                this.isTransitioning = false;
                            }, 500);
                        }
                    }

                    prevSlide() {
                        if (this.currentIndex > 0 && !this.isTransitioning) {
                            this.isTransitioning = true;
                            this.currentIndex--;
                            this.updateCarousel();
                            this.resetAutoPlay();

                            setTimeout(() => {
                                this.isTransitioning = false;
                            }, 500);
                        }
                    }

                    goToSlide(index) {
                        if (index !== this.currentIndex && !this.isTransitioning) {
                            this.isTransitioning = true;
                            this.currentIndex = index;
                            this.updateCarousel();
                            this.resetAutoPlay();

                            setTimeout(() => {
                                this.isTransitioning = false;
                            }, 500);
                        }
                    }

                    startAutoPlay() {
                        this.autoPlayInterval = setInterval(() => {
                            if (this.currentIndex === this.maxIndex) {
                                this.currentIndex = 0;
                            } else {
                                this.currentIndex++;
                            }
                            this.updateCarousel();
                        }, this.autoPlayDelay);
                    }

                    stopAutoPlay() {
                        if (this.autoPlayInterval) {
                            clearInterval(this.autoPlayInterval);
                            this.autoPlayInterval = null;
                        }
                    }

                    resetAutoPlay() {
                        this.stopAutoPlay();
                        this.startAutoPlay();
                    }

                    handleResize() {
                        const newSlidesToShow = this.getSlidesToShow();
                        if (newSlidesToShow !== this.slidesToShow) {
                            this.slidesToShow = newSlidesToShow;
                            this.maxIndex = Math.max(0, this.totalSlides - this.slidesToShow);

                            if (this.currentIndex > this.maxIndex) {
                                this.currentIndex = this.maxIndex;
                            }

                            this.createIndicators();
                            this.updateCarousel();
                        }
                    }

                    bindEvents() {
                        // Navigation buttons
                        if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                        if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());

                        // Pause autoplay on hover
                        this.carousel.addEventListener('mouseenter', () => this.stopAutoPlay());
                        this.carousel.addEventListener('mouseleave', () => this.startAutoPlay());

                        // Touch/swipe support
                        let startX = 0;
                        let startY = 0;
                        let distX = 0;
                        let distY = 0;

                        this.carousel.addEventListener('touchstart', (e) => {
                            startX = e.changedTouches[0].pageX;
                            startY = e.changedTouches[0].pageY;
                        });

                        this.carousel.addEventListener('touchmove', (e) => {
                            e.preventDefault();
                        });

                        this.carousel.addEventListener('touchend', (e) => {
                            distX = e.changedTouches[0].pageX - startX;
                            distY = e.changedTouches[0].pageY - startY;

                            if (Math.abs(distX) > Math.abs(distY) && Math.abs(distX) > 50) {
                                if (distX > 0) {
                                    this.prevSlide();
                                } else {
                                    this.nextSlide();
                                }
                            }
                        });

                        // Keyboard navigation
                        document.addEventListener('keydown', (e) => {
                            if (e.key === 'ArrowLeft') {
                                this.prevSlide();
                            } else if (e.key === 'ArrowRight') {
                                this.nextSlide();
                            }
                        });
                    }
                }

                // Initialize Services Carousel
                const servicesCarousel = new UniversalCarousel({
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

                // Initialize Partners Carousel
                const partnersCarousel = new UniversalCarousel({
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Intersection Observer untuk animasi scroll
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                            // Optional: stop observing setelah animasi
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Observe semua news cards
                const newsCards = document.querySelectorAll('.news-card');
                newsCards.forEach(card => {
                    observer.observe(card);
                });

                // Parallax effect untuk header section
                window.addEventListener('scroll', () => {
                    const scrolled = window.pageYOffset;
                    const beritaSection = document.getElementById('berita');

                    if (beritaSection) {
                        const rate = scrolled * -0.5;
                        beritaSection.style.transform = `translateY(${rate}px)`;
                    }
                });

                // Stagger animation untuk cards
                const staggerCards = () => {
                    const cards = document.querySelectorAll('.news-card');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.style.animationDelay = `${index * 0.1}s`;
                            card.classList.add('animate');
                        }, index * 100);
                    });
                };

                // Trigger stagger animation on page load
                setTimeout(staggerCards, 500);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carousel = document.getElementById('teamCarousel');

                if (carousel) {
                    // Pause on hover
                    carousel.addEventListener('mouseenter', function() {
                        this.style.animationPlayState = 'paused';
                    });

                    // Resume on mouse leave
                    carousel.addEventListener('mouseleave', function() {
                        this.style.animationPlayState = 'running';
                    });

                    // Pause when tab is not visible (performance optimization)
                    document.addEventListener('visibilitychange', function() {
                        if (document.hidden) {
                            carousel.style.animationPlayState = 'paused';
                        } else {
                            carousel.style.animationPlayState = 'running';
                        }
                    });
                }
            });
        </script>

    </body>

</html>
