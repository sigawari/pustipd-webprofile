<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Style tetap sama seperti sebelumnya --}}
    <style>
        .underline-animate::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 0;
            height: 4px;
            width: 0;
            background-color: #062749;
            transition: width 0.4s ease;
        }

        .group:hover .underline-animate::after {
            width: 100%;
        }

        .gallery-card {
            position: relative;
            width: 200px;
            height: 200px;
            cursor: pointer;
        }

        .gallery-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px 0 rgb(0 0 0 / 5%);
            background: #f3f4f6;
            display: block;
        }

        /* ===== MOBILE RESPONSIVE - 100px ===== */
        @media (max-width: 768px) {
            .gallery-card {
                width: 100px;
                height: 100px;
            }

            .gallery-img {
                width: 100px;
                height: 100px;
                border-radius: 0.5rem;
                /* Sedikit lebih kecil border radius untuk mobile */
            }

            .caption-hover {
                font-size: 0.75rem;
                /* Ukuran font lebih kecil di mobile */
                padding: 0 4px;
                /* Padding lebih kecil */
                border-radius: 0.5rem;
                /* Sesuaikan dengan gambar */
            }
        }

        /* ===== TABLET RESPONSIVE - 150px (Optional) ===== */
        @media (min-width: 769px) and (max-width: 1024px) {
            .gallery-card {
                width: 150px;
                height: 150px;
            }

            .gallery-img {
                width: 150px;
                height: 150px;
            }

            .caption-hover {
                font-size: 0.85rem;
                padding: 0 6px;
            }
        }

        .caption-hover {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            background: rgba(6, 39, 73, 0.6);
            color: #fff;
            text-shadow: 0 2px 4px rgb(0, 0, 0, 0.2);
            font-size: 0.93rem;
            font-weight: 600;
            border-radius: 0.75rem;
            text-align: center;
            transition: opacity 0.25s;
            pointer-events: none;
            padding: 0 8px;
        }

        .gallery-card:hover .caption-hover {
            opacity: 1;
            pointer-events: auto;
        }

        .gallery-popup-bg {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }

        .gallery-popup-bg.active {
            display: flex;
        }

        .gallery-popup-box {
            background: #fff;
            border-radius: 0.75rem;
            max-width: 92vw;
            max-height: 88vh;
            box-shadow: 0 6px 32px 0 rgb(0 0 0 / 20%);
            padding: 18px 18px 24px 18px;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .gallery-popup-img {
            max-width: 80vw;
            max-height: 60vh;
            border-radius: 0.5rem;
            margin-top: 8px;
        }

        .popup-caption {
            color: #314061;
            font-size: 1.05rem;
            margin-bottom: 8px;
            font-weight: 600;
            text-align: center;
        }

        /* ===== POPUP MOBILE RESPONSIVE ===== */
        @media (max-width: 768px) {
            .gallery-popup-box {
                max-width: 95vw;
                max-height: 90vh;
                padding: 12px 12px 18px 12px;
            }

            .gallery-popup-img {
                max-width: 85vw;
                max-height: 65vh;
            }

            .popup-caption {
                font-size: 0.95rem;
            }

            .popup-close {
                padding: 0.3rem 1rem;
                font-size: 0.9rem;
            }
        }

        .popup-close {
            position: static;
            margin-top: 16px;
            background: #062749;
            color: #fff;
            border-radius: 10px;
            border: none;
            padding: 0.4rem 1.2rem;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            z-index: 10;
        }

        .content-about {
            max-width: 600px;
        }

        /* Style untuk empty state */
        .empty-gallery {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-gallery svg {
            color: #9CA3AF;
        }

        /* ===== MOBILE GALLERY CONTAINER ===== */
        @media (max-width: 768px) {
            .gallery-container {
                gap: 0.75rem;
                /* Gap lebih kecil di mobile */
            }
        }
    </style>


    <section id="about" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">
            <!-- Heading centered top -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Tentang PUSTIPD
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Apa itu PUSTIPD?
                </h3>
            </div>

            <!-- Content with image left and text right -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 max-w-5xl mx-auto">
                <!-- Image left -->
                <div class="flex-shrink-0 w-full lg:w-2/5">
                    <img src="{{ Storage::url($profil->profil_photo) ?? asset('assets/img/placeholder/dummy.png') }}"
                        alt="Foto PUSTIPD"
                        class="w-full h-full rounded-xl object-cover aspect-[2/1] shadow-md bg-gray-100" />
                </div>

                <!-- Text right -->
                <div class="content-about text-secondary text-lg w-full lg:w-3/5 text-justify">
                    <p>
                        {{ $profil->description ?? 'Pusat Teknologi Informasi dan Pangkalan Data' }}
                    </p>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">Galeri Kegiatan</h3>

                @if ($galleries->count() > 0)
                    <div class="flex flex-wrap justify-center gap-6">
                        @foreach ($galleries as $idx => $gallery)
                            <div class="gallery-card" data-idx="{{ $idx }}">
                                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="gallery-img"
                                    loading="lazy" />
                                <div class="caption-hover">{{ $gallery->title }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-gallery">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-lg text-secondary">Galeri kegiatan akan segera hadir</p>
                        <p class="text-sm text-gray-500 mt-2">Admin sedang menyiapkan foto-foto kegiatan terbaru</p>
                    </div>
                @endif
            </div>

            <!-- Modal Popup for gallery -->
            @if ($galleries->count() > 0)
                <div id="gallery-popup" class="gallery-popup-bg" tabindex="-1" role="dialog" aria-modal="true"
                    aria-labelledby="popup-caption">
                    <div class="gallery-popup-box">
                        <div id="popup-caption" class="popup-caption"></div>
                        <div id="popup-description" class="text-sm text-gray-600 mb-4 px-4 text-center max-w-md"></div>
                        <div id="popup-event-date" class="text-xs text-gray-500 mb-4"></div>
                        <img id="popup-img" class="gallery-popup-img" src="" alt="Foto galeri yang diperbesar"
                            loading="lazy" />
                        <button class="popup-close pt-2 pb-0.5" id="popup-close"
                            aria-label="Tutup Galeri">Tutup</button>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if ($galleries->count() > 0)
        <script>
            // Gunakan hanya satu definisi galleries dari controller (galleriesData)
            const galleries = @json($galleriesData);
            console.log('Galleries data:', galleries);

            document.addEventListener('DOMContentLoaded', function() {
                const galleryCards = document.querySelectorAll('.gallery-card');
                const popup = document.getElementById('gallery-popup');
                const popupImg = document.getElementById('popup-img');
                const popupCaption = document.getElementById('popup-caption');
                const popupDescription = document.getElementById('popup-description');
                const popupEventDate = document.getElementById('popup-event-date');
                const closeBtn = document.getElementById('popup-close');

                if (!popup) {
                    console.warn('Gallery popup not found');
                    return;
                }

                galleryCards.forEach(card => {
                    card.addEventListener('click', function() {
                        const idx = Number(card.dataset.idx);
                        const gallery = galleries[idx];

                        if (gallery) {
                            popupImg.src = gallery.image;
                            popupImg.alt = gallery.title;
                            popupCaption.textContent = gallery.title;
                            popupDescription.textContent = gallery.description || '';
                            popupEventDate.textContent = gallery.event_date ?
                                `📅 ${gallery.event_date}` : '';

                            // Sembunyikan elemen kosong
                            popupDescription.style.display = gallery.description ? 'block' : 'none';
                            popupEventDate.style.display = gallery.event_date ? 'block' : 'none';

                            popup.classList.add('active');
                            popup.focus();
                        }
                    });
                });

                closeBtn?.addEventListener('click', function() {
                    popup.classList.remove('active');
                });

                popup?.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.classList.remove('active');
                    }
                });

                window.addEventListener('keydown', function(e) {
                    if (popup?.classList.contains('active') && e.key === 'Escape') {
                        popup.classList.remove('active');
                    }
                });
            });
        </script>
    @endif

</x-public.layouts>
