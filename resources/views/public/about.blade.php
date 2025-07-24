@php
    $gallery = [
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Sosialisasi Sistem Informasi PUSTIPD'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Maintenance jaringan rutin'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Pelatihan Digitalisasi Kampus'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Tim IT PUSTIPD UIN Raden Fatah'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Seminar Teknologi Informasi'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Lomba Inovasi Digital'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Pendampingan UMKM Digital'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Workshop Data Analytics'],
        // Tambah lagi jika perlu...
    ];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .underline-animate::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            /* Jarak dari teks */
            left: 0;
            height: 4px;
            width: 0;
            background-color: #062749;
            /* Tailwind blue-500 */
            transition: width 0.4s ease;
        }

        .group:hover .underline-animate::after {
            width: 100%;
        }

        .gallery-card {
            position: relative;
            width: 100px;
            height: 100px;
            cursor: pointer;
        }

        .gallery-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px 0 rgb(0 0 0 / 5%);
            background: #f3f4f6;
            display: block;
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
            /* Tambah padding bawah supaya ada ruang tombol */
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
            /* beri jarak setelah caption */
        }

        .popup-caption {
            color: #314061;
            font-size: 1.05rem;
            margin-bottom: 8px;
            /* beri margin bawah supaya tidak mepet gambar */
            font-weight: 600;
            text-align: center;
        }

        .popup-close {
            position: static;
            /* hilangkan posisi absolut */
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

            /* Responsif container */
            .content-about {
                max-width: 600px;
            }

            @media (min-width: 1024px) {
                /* Reset gallery-img max-width if needed */
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
                    <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="Banner Tentang PUSTIPD"
                        class="w-full h-full rounded-xl object-cover aspect-[2/1] shadow-md bg-gray-100" />
                </div>

                <!-- Text right -->
                <div class="content-about text-secondary text-lg w-full lg:w-3/5 text-justify">
                    <p>
                        Pusat Teknologi Informasi dan Pangkalan Data (PUSTIPD) berkedudukan di bawah koordinasi dan
                        bertanggung jawab kepada Rektor melalui Wakil Rektor II. PUSTIPD berfungsi sebagai perencana,
                        pengelola, dan pemelihara infrastruktur sistem teknologi informasi dan komunikasi serta
                        mengkoordinasi pengembangan dan integrasi aplikasi dan sistem informasi di lingkungan UIN Raden
                        Fatah Palembang serta pelaporan data ke ForlapDikti
                    </p>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">Galeri Kegiatan</h3>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach ($gallery as $idx => $item)
                        <div class="gallery-card" data-idx="{{ $idx }}">
                            <img src="{{ $item['image'] }}" alt="Galeri {{ $idx + 1 }}" class="gallery-img" />
                            <div class="caption-hover">{{ $item['caption'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal Popup for gallery -->
            <div id="gallery-popup" class="gallery-popup-bg" tabindex="-1" role="dialog" aria-modal="true"
                aria-labelledby="popup-caption">
                <div class="gallery-popup-box">
                    <div id="popup-caption" class="popup-caption"></div>
                    <img id="popup-img" class="gallery-popup-img" src="" alt="Foto galeri yang diperbesar" />
                    <button class="popup-close pt-2 pb-0.5" id="popup-close" aria-label="Tutup Galeri">Tutup</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        const gallery = @json($gallery);
        document.addEventListener('DOMContentLoaded', function() {
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
</x-public.layouts>
