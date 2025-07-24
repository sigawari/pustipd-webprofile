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
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

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

                if (!isHome) {
                    // Jika bukan home, navbar langsung putih + text biru + topbar hidden
                    topbar.classList.add('hidden');

                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-white');

                    navbarTitle.classList.remove('text-white');
                    navbarTitle.classList.add('text-[#062749]');

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
                            navbarTitle.classList.add('text-[#062749]');

                            navLinks.forEach(link => {
                                link.classList.remove('text-white');
                                link.classList.add('text-[#062749]');
                            });
                        } else {
                            // HOME
                            const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                            navbar.classList.remove('bg-transparent');
                            navbar.classList.add(isDark ? 'bg-gray-900' : 'bg-white');

                            if (isDark) {
                                navbarTitle.classList.add('text-white');
                                navbarTitle.classList.remove('text-[#062749]');

                                navLinks.forEach(link => {
                                    link.classList.add('text-white');
                                    link.classList.remove('text-[#062749]');
                                });
                            } else {
                                navbarTitle.classList.remove('text-white');
                                navbarTitle.classList.add('text-[#062749]');

                                navLinks.forEach(link => {
                                    link.classList.remove('text-white');
                                    link.classList.add('text-[#062749]');
                                });
                            }
                        }

                    } else {
                        if (isHome) {
                            // HOME SCROLL UP
                            topbar.classList.remove('hidden');

                            navbar.classList.remove('bg-white', 'bg-gray-900');
                            navbar.classList.add('bg-transparent');

                            navbarTitle.classList.add('text-white');
                            navbarTitle.classList.remove('text-[#062749]');

                            navLinks.forEach(link => {
                                link.classList.add('text-white');
                                link.classList.remove('text-[#062749]');
                            });
                        } else {
                            // PAGE LAIN SCROLL UP → tetap putih + text biru
                            topbar.classList.add('hidden');

                            navbar.classList.remove('bg-transparent', 'bg-gray-900');
                            navbar.classList.add('bg-white');

                            navbarTitle.classList.remove('text-white');
                            navbarTitle.classList.add('text-[#062749]');

                            navLinks.forEach(link => {
                                link.classList.remove('text-white');
                                link.classList.add('text-[#062749]');
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

    </body>

</html>
