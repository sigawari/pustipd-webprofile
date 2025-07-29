<x-public.layouts title="Contoh Judul Berita" description="Deskripsi singkat berita dummy"
    keywords="berita, pustipd, teknologi">
    <x-slot:title>Contoh Judul Berita</x-slot:title>

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

        .news-article-content {
            color: #272a33;
            font-size: 1.09rem;
            line-height: 1.7;
        }

        .news-date-cat {
            color: #4671af;
            font-weight: 500;
            font-size: 0.97rem;
            margin-bottom: 1rem;
        }

        .news-title-detail {
            color: #062749;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 1.15rem;
            text-align: center;
        }

        .news-img-detail {
            width: 100%;
            max-width: 820px;
            max-height: 420px;
            display: block;
            object-fit: cover;
            border-radius: 1rem;
            margin: 1.5rem auto 2.5rem auto;
            box-shadow: 0 2px 16px rgba(6, 39, 73, 0.08);
            background: #f5f6fa;
        }

        .share-btn-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin: 1.8rem 0 2.4rem 0;
        }

        .main-share-btn {
            background: #062749;
            color: #fff;
            font-weight: 600;
            border: none;
            outline: none;
            border-radius: 2rem;
            padding: 0.68rem 1.8rem;
            font-size: 1.09rem;
            cursor: pointer;
            box-shadow: 0 2px 10px 0 rgba(6, 39, 73, 0.06);
            display: flex;
            align-items: center;
            gap: 0.7em;
            transition: background 0.22s;
        }

        .main-share-btn:hover {
            background: #82BEE0;
        }

        .share-choices {
            display: none;
            flex-direction: row;
            gap: 0.65rem;
            margin-top: 1.2rem;
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 6px 25px 0 rgba(60, 90, 140, 0.07);
            padding: 10px 20px;
            z-index: 20;
            animation: fadeInUp .18s ease;
        }

        .share-choices.active {
            display: flex;
        }

        .choice-btn {
            background: #e4eaf2;
            color: #062749;
            border-radius: 2rem;
            padding: 0.45rem 1.15rem;
            border: none;
            outline: none;
            cursor: pointer;
            font-weight: 600;
            font-size: .96rem;
            display: flex;
            align-items: center;
            gap: 0.4em;
            transition: background .14s;
        }

        .choice-btn:hover {
            background: #cdd3e0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 900px) {
            .news-img-detail {
                max-width: 99vw;
            }
        }

        @media (max-width: 640px) {
            .news-title-detail {
                font-size: 1.2rem;
            }

            .news-img-detail {
                max-width: 99vw;
                height: auto;
            }

            .news-article-content {
                font-size: 1rem;
            }

            .share-choices {
                padding: 8px 5px;
                flex-wrap: wrap;
            }
        }

        .news-full-article-container {
            background: #fff;
            border-radius: 1.2rem;
            padding: 2.7rem 2.1rem 2.2rem;
            box-shadow: 0 2px 18px rgba(6, 39, 73, .07);
            margin: auto;
            max-width: 900px;
        }
    </style>

    <section id="berita-detail" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">
            <!-- Heading Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Berita
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Berita terbaru dari PUSTIPD
                </h3>
            </div>

            <div class="news-full-article-container mx-auto">
                <h1 class="news-title-detail" id="judul-berita">
                    Peluncuran Sistem Informasi Terbaru PUSTIPD
                </h1>
                <img src="{{ asset('assets/img/placeholder/dummy.png') }}"
                    alt="Peluncuran Sistem Informasi Terbaru PUSTIPD" class="news-img-detail" />

                <div class="news-date-cat mb-2 text-center">
                    Teknologi &middot; <span>23 Juli 2025</span>
                </div>
                <!-- Share button -->
                <div class="share-btn-wrap">
                    <button class="main-share-btn" id="mainShareBtn" type="button">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z" />
                        </svg>
                        Bagikan
                    </button>
                    <div class="share-choices" id="shareChoices" tabindex="0">
                        <button class="choice-btn" onclick="shareTo('wa')" type="button" title="Bagikan ke WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('fb')" type="button" title="Bagikan ke Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M10.488 3.788A5.25 5.25 0 0 1 14.2 2.25h2.7a.75.75 0 0 1 .75.75v3.6a.75.75 0 0 1-.75.75h-2.7a.15.15 0 0 0-.15.15v1.95h2.85a.75.75 0 0 1 .728.932l-.9 3.6a.75.75 0 0 1-.728.568h-1.95V21a.75.75 0 0 1-.75.75H9.7a.75.75 0 0 1-.75-.75v-6.45H7a.75.75 0 0 1-.75-.75v-3.6A.75.75 0 0 1 7 9.45h1.95V7.5a5.25 5.25 0 0 1 1.538-3.712M14.2 3.75a3.75 3.75 0 0 0-3.75 3.75v2.7a.75.75 0 0 1-.75.75H7.75v2.1H9.7a.75.75 0 0 1 .75.75v6.45h2.1V13.8a.75.75 0 0 1 .75-.75h2.114l.525-2.1H13.3a.75.75 0 0 1-.75-.75V7.5a1.65 1.65 0 0 1 1.65-1.65h1.95v-2.1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('ig')" type="button" title="Bagikan ke Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('tg')" type="button" title="Bagikan ke Telegram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M5.788 14.02a1 1 0 0 0 .132.031a456 456 0 0 1 .844 2.002c.503 1.202 1.01 2.44 1.121 2.796c.139.438.285.736.445.94c.083.104.178.196.29.266a1 1 0 0 0 .186.088c.32.12.612.07.795.009a1.3 1.3 0 0 0 .304-.15L9.91 20l2.826-1.762l3.265 2.502q.072.055.156.093c.392.17.772.23 1.13.182c.356-.05.639-.199.85-.368a2 2 0 0 0 .564-.728l.009-.022l.003-.008l.002-.004v-.002l.001-.001a1 1 0 0 0 .04-.133l2.98-15.025a1 1 0 0 0 .014-.146c0-.44-.166-.859-.555-1.112c-.334-.217-.705-.227-.94-.209c-.252.02-.486.082-.643.132a4 4 0 0 0-.26.094l-.011.005l-16.714 6.556l-.002.001a2 2 0 0 0-.167.069a2.5 2.5 0 0 0-.38.212c-.227.155-.75.581-.661 1.285c.07.56.454.905.689 1.071c.128.091.25.156.34.199c.04.02.126.054.163.07l.01.003zm14.138-9.152h-.002l-.026.011l-16.734 6.565l-.026.01l-.01.003a1 1 0 0 0-.09.04a1 1 0 0 0 .086.043l3.142 1.058a1 1 0 0 1 .16.076l10.377-6.075l.01-.005a2 2 0 0 1 .124-.068c.072-.037.187-.091.317-.131c.09-.028.357-.107.645-.014a.85.85 0 0 1 .588.689a.84.84 0 0 1 .003.424c-.07.275-.262.489-.437.653c-.15.14-2.096 2.016-4.015 3.868l-2.613 2.52l-.465.45l5.872 4.502a.54.54 0 0 0 .251.04a.23.23 0 0 0 .117-.052a.5.5 0 0 0 .103-.12l.002-.001l2.89-14.573a2 2 0 0 0-.267.086zm-8.461 12.394l-1.172-.898l-.284 1.805zm-2.247-2.68l1.165-1.125l2.613-2.522l.973-.938l-6.52 3.817l.035.082a339 339 0 0 1 1.22 2.92l.283-1.8a.75.75 0 0 1 .231-.435"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="copyBeritaLink()" type="button" title="Salin Link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5">
                                    <path
                                        d="M19.4 20H9.6a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h9.8a.6.6 0 0 1 .6.6v9.8a.6.6 0 0 1-.6.6" />
                                    <path d="M15 9V4.6a.6.6 0 0 0-.6-.6H4.6a.6.6 0 0 0-.6.6v9.8a.6.6 0 0 0 .6.6H9" />
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Konten detail berita (rich HTML dummy) -->
                <div>
                    <p>
                        Sistem informasi baru telah diluncurkan oleh PUSTIPD UIN Raden Fatah Palembang untuk
                        meningkatkan pelayanan digital dan efisiensi operasional. Sistem ini memiliki berbagai fitur
                        baru, termasuk dashboard interaktif, analytics real-time, dan integrasi layanan kampus yang
                        lebih baik.
                    </p>
                    <blockquote
                        style="font-style:italic;background:#f2f2f6;border-left:4px solid #062749;padding:13px 20px;margin:30px 0 23px 0;border-radius:0 7px 7px 0;">
                        "Dengan sistem baru ini, proses administrasi menjadi lebih cepat dan transparan," ujar Kepala
                        PUSTIPD.</blockquote>
                    <p>
                        Sosialisasi dan pelatihan kepada seluruh staf, dosen, dan mahasiswa akan dilaksanakan mulai awal
                        Agustus 2025. Diharapkan dengan implementasi sistem ini, seluruh civitas akademika UIN RF
                        Palembang akan semakin mudah dalam mengakses informasi serta mendukung proses digitalisasi
                        kampus yang berkelanjutan.
                    </p>
                    <ul style="margin:22px 0 4px 20px;padding-left:7px;">
                        <li>Dashboard monitoring per unit</li>
                        <li>Otentikasi Single Sign-On (SSO)</li>
                        <li>Laporan real-time dan paperless</li>
                    </ul>
                    <p style="margin-top:25px;">
                        Untuk pertanyaan lebih lanjut, silakan hubungi <a href="mailto:pustipd@uinradenfatah.ac.id"
                            class="text-custom-blue underline">pustipd@uinradenfatah.ac.id</a> atau follow akun media
                        sosial kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Toggle Share Choices
        document.addEventListener('DOMContentLoaded', function() {
            const mainBtn = document.getElementById('mainShareBtn');
            const shareChoices = document.getElementById('shareChoices');
            let opened = false;

            mainBtn.addEventListener('click', function(e) {
                shareChoices.classList.toggle('active');
                opened = !opened;
                if (opened) shareChoices.focus();
            });

            // Hide on click outside
            document.addEventListener('click', function(e) {
                if (opened && !mainBtn.contains(e.target) && !shareChoices.contains(e.target)) {
                    shareChoices.classList.remove('active');
                    opened = false;
                }
            });

            // Hide on Esc
            shareChoices.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    shareChoices.classList.remove('active');
                    opened = false;
                    mainBtn.blur();
                }
            });
        });

        // Share logic
        function getDummyTitle() {
            return document.getElementById('judul-berita')?.innerText || 'Peluncuran Sistem Informasi Terbaru PUSTIPD';
        }

        function shareTo(platform) {
            var judul = getDummyTitle();
            var url = window.location.href;
            var shareText = "Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul + " " + url;

            if (platform === 'wa') {
                window.open('https://wa.me/?text=' + encodeURIComponent(shareText), '_blank');
            }
            if (platform === 'fb') {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'ig') {
                window.open('https://www.instagram.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'tg') {
                window.open('https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' +
                    encodeURIComponent("Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
        }

        function copyBeritaLink() {
            var judul = getDummyTitle();
            var url = window.location.href;
            var hasil = "Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul + " " + url;
            navigator.clipboard.writeText(hasil).then(function() {
                alert('Link berita telah disalin!');
            });
        }
    </script>
</x-public.layouts>
