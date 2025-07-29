<x-public.layouts title="Contoh Judul Pengumuman" description="Deskripsi singkat pengumuman dummy"
    keywords="pengumuman, pustipd, urgent">
    <x-slot:title>Pengumuman Terbaru</x-slot:title>

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

        .announcement-article-content {
            color: #062749;
            font-size: 1.09rem;
            line-height: 1.7;
        }

        .announcement-date-cat {
            color: #dc2626;
            font-weight: 500;
            font-size: 0.97rem;
            margin-bottom: 1rem;
        }

        .announcement-title-detail {
            color: #062749;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 0.7rem;
            text-align: center;
        }

        .share-btn-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin: 1.8rem 0 2.4rem 0;
        }

        .main-share-btn {
            background: #dc2626;
            color: #fff;
            font-weight: 600;
            border: none;
            outline: none;
            border-radius: 0.5rem;
            padding: 0.68rem 1.8rem;
            font-size: 1.09rem;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.2);
            display: flex;
            align-items: center;
            gap: 0.7em;
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .main-share-btn:hover {
            background: #dc4444;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.3);
        }

        .share-choices {
            display: none;
            flex-direction: row;
            gap: 0.65rem;
            margin-top: 0.8rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 35px rgba(220, 38, 38, 0.1);
            padding: 12px 24px;
            z-index: 20;
            animation: fadeInUp .18s ease;
            border: 1px solid #fecaca;
        }

        .share-choices.active {
            display: flex;
        }

        .choice-btn {
            background: #fef2f2;
            color: #dc2626;
            border-radius: 0.5rem;
            padding: 0.5rem 1.2rem;
            border: 1px solid #fecaca;
            outline: none;
            cursor: pointer;
            font-weight: 600;
            font-size: .96rem;
            display: flex;
            align-items: center;
            gap: 0.4em;
            transition: all .2s ease;
        }

        .choice-btn:hover {
            background: #dc2626;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }

        .announcement-full-article-container {
            background: #fff;
            border-radius: 1rem;
            padding: 2.7rem 2.1rem 2.2rem;
            box-shadow: 0 4px 25px rgba(220, 38, 38, 0.08);
            margin: auto;
            max-width: 900px;
            position: relative;
            overflow: hidden;
        }

        .announcement-full-article-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.1rem;
            padding: 0.5rem 1rem;
            background: #fef2f2;
            border-radius: 0.5rem;
            color: #dc2626;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .urgent-badge {
            animation: pulse 2s infinite;
        }

        .expiry-notice {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin: 1.5rem auto;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0.75rem;
            box-shadow: 0 4px 12px rgba(254, 215, 170, 0.3);
            color: #ea580c;
            position: relative;
        }

        .announcement-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: #fef2f2;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            margin-bottom: 1rem;
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

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        @media (max-width: 900px) {
            .announcement-img-detail {
                max-width: 99vw;
            }
        }

        @media (max-width: 640px) {
            .announcement-title-detail {
                font-size: 1.4rem;
            }

            .announcement-img-detail {
                max-width: 99vw;
                height: auto;
            }

            .announcement-article-content {
                font-size: 1rem;
            }

            .share-choices {
                padding: 8px 12px;
                flex-wrap: wrap;
            }

            .announcement-full-article-container {
                padding: 1.5rem 1.2rem;
            }
        }
    </style>

    <section id="pengumuman-detail" class="py-20 mt-8 bg-gray-50">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">
            <!-- Heading Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Pengumuman
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Pengumuman terbaru dari PUSTIPD
                </h3>
            </div>

            <div class="announcement-full-article-container mx-auto">
                <h1 class="announcement-title-detail" id="judul-pengumuman">
                    Peluncuran Sistem Informasi Terbaru PUSTIPD
                </h1>

                <div class="announcement-date-cat mb-2 text-center">
                    Teknologi &middot; <span>23 Juli 2025</span>
                </div>

                <div class="flex items-center justify-center mb-4">
                    <!-- Priority Badge -->
                    <div class="priority-badge urgent-badge inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        URGENT - Pengumuman Penting
                    </div>
                </div>
                <!-- Share button -->
                <div class="share-btn-wrap">
                    <button class="main-share-btn" id="mainShareBtn" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z" />
                        </svg>
                        Bagikan
                    </button>
                    <div class="share-choices" id="shareChoices" tabindex="0">
                        <button class="choice-btn" onclick="shareTo('wa')" type="button" title="Bagikan ke WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('fb')" type="button" title="Bagikan ke Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M10.488 3.788A5.25 5.25 0 0 1 14.2 2.25h2.7a.75.75 0 0 1 .75.75v3.6a.75.75 0 0 1-.75.75h-2.7a.15.15 0 0 0-.15.15v1.95h2.85a.75.75 0 0 1 .728.932l-.9 3.6a.75.75 0 0 1-.728.568h-1.95V21a.75.75 0 0 1-.75.75H9.7a.75.75 0 0 1-.75-.75v-6.45H7a.75.75 0 0 1-.75-.75v-3.6A.75.75 0 0 1 7 9.45h1.95V7.5a5.25 5.25 0 0 1 1.538-3.712M14.2 3.75a3.75 3.75 0 0 0-3.75 3.75v2.7a.75.75 0 0 1-.75.75H7.75v2.1H9.7a.75.75 0 0 1 .75.75v6.45h2.1V13.8a.75.75 0 0 1 .75-.75h2.114l.525-2.1H13.3a.75.75 0 0 1-.75-.75V7.5a1.65 1.65 0 0 1 1.65-1.65h1.95v-2.1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('ig')" type="button" title="Bagikan ke Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="shareTo('tg')" type="button" title="Bagikan ke Telegram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M5.788 14.02a1 1 0 0 0 .132.031a456 456 0 0 1 .844 2.002c.503 1.202 1.01 2.44 1.121 2.796c.139.438.285.736.445.94c.083.104.178.196.29.266a1 1 0 0 0 .186.088c.32.12.612.07.795.009a1.3 1.3 0 0 0 .304-.15L9.91 20l2.826-1.762l3.265 2.502q.072.055.156.093c.392.17.772.23 1.13.182c.356-.05.639-.199.85-.368a2 2 0 0 0 .564-.728l.009-.022l.003-.008l.002-.004v-.002l.001-.001a1 1 0 0 0 .04-.133l2.98-15.025a1 1 0 0 0 .014-.146c0-.44-.166-.859-.555-1.112c-.334-.217-.705-.227-.94-.209c-.252.02-.486.082-.643.132a4 4 0 0 0-.26.094l-.011.005l-16.714 6.556l-.002.001a2 2 0 0 0-.167.069a2.5 2.5 0 0 0-.38.212c-.227.155-.75.581-.661 1.285c.07.56.454.905.689 1.071c.128.091.25.156.34.199c.04.02.126.054.163.07l.01.003zm14.138-9.152h-.002l-.026.011l-16.734 6.565l-.026.01l-.01.003a1 1 0 0 0-.09.04a1 1 0 0 0 .086.043l3.142 1.058a1 1 0 0 1 .16.076l10.377-6.075l.01-.005a2 2 0 0 1 .124-.068c.072-.037.187-.091.317-.131c.09-.028.357-.107.645-.014a.85.85 0 0 1 .588.689a.84.84 0 0 1 .003.424c-.07.275-.262.489-.437.653c-.15.14-2.096 2.016-4.015 3.868l-2.613 2.52l-.465.45l5.872 4.502a.54.54 0 0 0 .251.04a.23.23 0 0 0 .117-.052a.5.5 0 0 0 .103-.12l.002-.001l2.89-14.573a2 2 0 0 0-.267.086zm-8.461 12.394l-1.172-.898l-.284 1.805zm-2.247-2.68l1.165-1.125l2.613-2.522l.973-.938l-6.52 3.817l.035.082a339 339 0 0 1 1.22 2.92l.283-1.8a.75.75 0 0 1 .231-.435"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button class="choice-btn" onclick="copyPengumumanLink()" type="button" title="Salin Link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
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

                <!-- Konten detail pengumuman -->
                <div class="announcement-article-content">
                    <p>
                        Sistem informasi baru telah diluncurkan oleh PUSTIPD UIN Raden Fatah Palembang untuk
                        meningkatkan pelayanan digital dan efisiensi operasional. Sistem ini memiliki berbagai fitur
                        baru, termasuk dashboard interaktif, analytics real-time, dan integrasi layanan kampus yang
                        lebih baik.
                    </p>
                    <blockquote
                        style="font-style:italic;background:#fef2f2;border-left:4px solid #dc2626;padding:13px 20px; margin:30px 0 23px 0;border-radius:0 7px 7px 0;">
                        "Dengan sistem baru ini, proses administrasi menjadi lebih cepat dan transparan," ujar Kepala
                        PUSTIPD.</blockquote>
                    <p>
                        Sosialisasi dan pelatihan kepada seluruh staf, dosen, dan mahasiswa akan dilaksanakan mulai awal
                        Agustus 2025. Diharapkan dengan implementasi sistem ini, seluruh civitas akademika UIN RF
                        Palembang akan semakin mudah dalam mengakses informasi serta mendukung proses digitalisasi
                        kampus yang berkelanjutan.
                    </p>

                    <div
                        style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:20px;margin:25px 0;">
                        <h4 style="color:#dc2626;font-weight:bold;margin-bottom:15px;">Fitur Utama Sistem Baru:</h4>
                        <ul style="margin:0;padding-left:20px;color:#4b5563;">
                            <li style="margin-bottom:8px;">Dashboard monitoring per unit</li>
                            <li style="margin-bottom:8px;">Otentikasi Single Sign-On (SSO)</li>
                            <li style="margin-bottom:8px;">Laporan real-time dan paperless</li>
                        </ul>
                    </div>

                    <p style="margin-top:25px;">
                        Untuk pertanyaan lebih lanjut, silakan hubungi <a href="mailto:pustipd@uinradenfatah.ac.id"
                            class="text-red-600 underline font-semibold hover:text-red-700">pustipd@uinradenfatah.ac.id</a>
                        atau follow akun media
                        sosial kami.
                    </p>
                </div>

                <!-- Expiry Notice -->
                <div class="expiry-notice">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <strong>Batas Waktu Pengumuman:</strong> 30 Juli 2025, 23:59 WIB
                        <br>
                        <small>Pengumuman ini akan otomatis dihapus setelah tanggal tersebut</small>
                    </div>
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
            return document.getElementById('judul-pengumuman')?.innerText || 'Peluncuran Sistem Informasi Terbaru PUSTIPD';
        }

        function shareTo(platform) {
            var judul = getDummyTitle();
            var url = window.location.href;
            var shareText = "Pengumuman Penting dari PUSTIPD UIN RF Palembang - " + judul + " " + url;

            if (platform === 'wa') {
                window.open('https://wa.me/?text=' + encodeURIComponent(shareText), '_blank');
            }
            if (platform === 'fb') {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Pengumuman Penting dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'ig') {
                window.open('https://www.instagram.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'tg') {
                window.open('https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' +
                    encodeURIComponent("Pengumuman Penting dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
        }

        function copyPengumumanLink() {
            var judul = getDummyTitle();
            var url = window.location.href;
            var hasil = "Pengumuman Penting dari PUSTIPD UIN RF Palembang - " + judul + " " + url;
            navigator.clipboard.writeText(hasil).then(function() {
                alert('Link pengumuman telah disalin!');
            });
        }
    </script>
</x-public.layouts>
