<x-public.layouts title="Tutorial Penggantian Email" description="Panduan lengkap tutorial dari PUSTIPD"
    keywords="tutorial, pustipd, panduan">
    <x-slot:title>Tutorial Terbaru</x-slot:title>

    <style>
        .group:hover .underline-animate::after {
            width: 100%;
        }

        .tutorial-article-content {
            color: #062749;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .tutorial-date-cat {
            color: #062749;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .tutorial-title-detail {
            color: #1f2937;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.8rem;
            text-align: center;
            background: linear-gradient(135deg, #062749, );
            background-clip: text;
        }

        .tutorial-header-section {
            border-radius: 1.5rem;
            padding: 0.2rem 1rem 1.5rem 2rem;
            margin-bottom: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .tutorial-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .share-btn-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin: 0.75rem 0 0.5rem 0;
        }

        .main-share-btn {
            background: #062749;
            color: #fff;
            font-weight: 600;
            border: none;
            outline: none;
            border-radius: 0.5rem;
            padding: 0.68rem 1.8rem;
            font-size: 1.09rem;
            cursor: pointer;
            box-shadow: 0 4px 14px #E6F6FF;
            display: flex;
            align-items: center;
            gap: 0.7em;
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .main-share-btn:hover {
            background: #82BEE0;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px #E6F6FF;
        }

        .share-choices {
            display: none;
            flex-direction: row;
            gap: 0.65rem;
            margin-top: 0.8rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 35px #E6F6FF;
            padding: 12px 24px;
            z-index: 20;
            animation: fadeInUp .18s ease;
            border: 1px solid #E6F6FF;
        }

        .share-choices.active {
            display: flex;
        }

        .choice-btn {
            background: #E6F6FF;
            color: #82BEE0;
            border-radius: 0.5rem;
            padding: 0.5rem 1.2rem;
            border: 1px solid #82BEE0;
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
            background: #82BEE0;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px #E6F6FF;
        }

        .tutorial-full-article-container {
            background: #fff;
            border-radius: 1.5rem;
            padding: 3rem 2.5rem;
            margin: auto;
            max-width: 900px;
            position: relative;
            overflow: hidden;
        }

        .tutorial-full-article-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #062749, , #F5FBFF);
        }

        .tutorial-step {
            background: linear-gradient(135deg, #062749, , #F5FBFF);
            border: 2px solid #82BEE0;
            border-radius: 1rem;
            padding: 1.5rem;
            margin: 2rem 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .tutorial-step:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px #E6F6FF;
        }

        .tutorial-step h4 {
            color: #062749;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .step-number {
            background: #062749;
            color: white;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .tutorial-tip {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-left: 4px solid #f59e0b;
            border-radius: 0 1rem 1rem 0;
            padding: 1.5rem;
            margin: 2rem 0;
            color: #92400e;
            font-style: italic;
            position: relative;
        }

        .tutorial-tip::before {
            content: '💡';
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.5rem;
        }

        .tutorial-tip-content {
            margin-left: 2.5rem;
        }

        .tutorial-step-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            max-height: 250px;
            object-fit: cover;
            border-radius: 0.75rem;
            margin: 1rem auto;
            display: block;
            box-shadow: 0 4px 15px #E6F6FF;
            border: 2px solid #82BEE0;
            background: #f0fdf4;
            transition: all 0.3s ease;
        }

        .tutorial-step-image:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px #E6F6FF;
        }

        .tutorial-step-image-placeholder {
            width: 100%;
            max-width: 400px;
            height: 200px;
            background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
            border: 2px dashed #E6F6FF;
            border-radius: 0.75rem;
            margin: 1rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #82BEE0;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
        }

        .tutorial-step-image-placeholder:hover {
            background: linear-gradient(135deg, #ecfdf5, #E6F6FF);
            border-color: #82BEE0;
        }

        .tutorial-step-image-placeholder svg {
            margin-bottom: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {

            .tutorial-step-image,
            .tutorial-step-image-placeholder {
                max-width: 100%;
                max-height: 200px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
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
                opacity: 0.7;
            }
        }

        @media (max-width: 640px) {
            .tutorial-title-detail {
                font-size: 2rem;
            }

            .tutorial-header-section {
                padding: 0.8rem;
            }

            .tutorial-full-article-container {
                padding: 2rem 1.5rem;
            }

            .share-choices {
                padding: 0.75rem 1rem;
                flex-wrap: wrap;
                gap: 0.3rem;
            }

            .choice-btn {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>

    <section id="tutorial-detail" class="py-20 mt-8 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">
            <!-- Heading Section -->
            <div class="text-center mb-8 group">
                <h2 class="text-4xl md:text-5xl font-bold text-secondary relative inline-block underline-animate mb-2">
                    Tutorial
                </h2>
                <h3 class="text-xl text-secondary pt-3 max-w-2xl mx-auto">
                    Panduan lengkap dan mudah diikuti dari PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            <div class="tutorial-full-article-container mx-auto">
                <!-- Tutorial Header Section -->
                <div class="tutorial-header-section">

                    <h1 class="tutorial-title-detail" id="judul-tutorial">
                        Tutorial Penggantian Email
                    </h1>

                    <div class="tutorial-date-cat">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Teknologi &middot; <span>23 Juli 2025</span>
                    </div>

                    <!-- Share button -->
                    <div class="share-btn-wrap">
                        <button class="main-share-btn" id="mainShareBtn" type="button">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                            </svg>
                            Bagikan
                        </button>
                        <div class="share-choices" id="shareChoices" tabindex="0">
                            <button class="choice-btn" onclick="shareTo('wa')" type="button"
                                title="Bagikan ke WhatsApp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                                </svg>
                            </button>
                            <button class="choice-btn" onclick="shareTo('fb')" type="button"
                                title="Bagikan ke Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M10.488 3.788A5.25 5.25 0 0 1 14.2 2.25h2.7a.75.75 0 0 1 .75.75v3.6a.75.75 0 0 1-.75.75h-2.7a.15.15 0 0 0-.15.15v1.95h2.85a.75.75 0 0 1 .728.932l-.9 3.6a.75.75 0 0 1-.728.568h-1.95V21a.75.75 0 0 1-.75.75H9.7a.75.75 0 0 1-.75-.75v-6.45H7a.75.75 0 0 1-.75-.75v-3.6A.75.75 0 0 1 7 9.45h1.95V7.5a5.25 5.25 0 0 1 1.538-3.712M14.2 3.75a3.75 3.75 0 0 0-3.75 3.75v2.7a.75.75 0 0 1-.75.75H7.75v2.1H9.7a.75.75 0 0 1 .75.75v6.45h2.1V13.8a.75.75 0 0 1 .75-.75h2.114l.525-2.1H13.3a.75.75 0 0 1-.75-.75V7.5a1.65 1.65 0 0 1 1.65-1.65h1.95v-2.1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="choice-btn" onclick="shareTo('ig')" type="button"
                                title="Bagikan ke Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                </svg>
                            </button>
                            <button class="choice-btn" onclick="shareTo('tg')" type="button"
                                title="Bagikan ke Telegram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M5.788 14.02a1 1 0 0 0 .132.031a456 456 0 0 1 .844 2.002c.503 1.202 1.01 2.44 1.121 2.796c.139.438.285.736.445.94c.083.104.178.196.29.266a1 1 0 0 0 .186.088c.32.12.612.07.795.009a1.3 1.3 0 0 0 .304-.15L9.91 20l2.826-1.762l3.265 2.502q.072.055.156.093c.392.17.772.23 1.13.182c.356-.05.639-.199.85-.368a2 2 0 0 0 .564-.728l.009-.022l.003-.008l.002-.004v-.002l.001-.001a1 1 0 0 0 .04-.133l2.98-15.025a1 1 0 0 0 .014-.146c0-.44-.166-.859-.555-1.112c-.334-.217-.705-.227-.94-.209c-.252.02-.486.082-.643.132a4 4 0 0 0-.26.094l-.011.005l-16.714 6.556l-.002.001a2 2 0 0 0-.167.069a2.5 2.5 0 0 0-.38.212c-.227.155-.75.581-.661 1.285c.07.56.454.905.689 1.071c.128.091.25.156.34.199c.04.02.126.054.163.07l.01.003zm14.138-9.152h-.002l-.026.011l-16.734 6.565l-.026.01l-.01.003a1 1 0 0 0-.09.04a1 1 0 0 0 .086.043l3.142 1.058a1 1 0 0 1 .16.076l10.377-6.075l.01-.005a2 2 0 0 1 .124-.068c.072-.037.187-.091.317-.131c.09-.028.357-.107.645-.014a.85.85 0 0 1 .588.689a.84.84 0 0 1 .003.424c-.07.275-.262.489-.437.653c-.15.14-2.096 2.016-4.015 3.868l-2.613 2.52l-.465.45l5.872 4.502a.54.54 0 0 0 .251.04a.23.23 0 0 0 .117-.052a.5.5 0 0 0 .103-.12l.002-.001l2.89-14.573a2 2 0 0 0-.267.086zm-8.461 12.394l-1.172-.898l-.284 1.805zm-2.247-2.68l1.165-1.125l2.613-2.522l.973-.938l-6.52 3.817l.035.082a339 339 0 0 1 1.22 2.92l.283-1.8a.75.75 0 0 1 .231-.435"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="choice-btn" onclick="copyTutorialLink()" type="button" title="Salin Link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5">
                                        <path
                                            d="M19.4 20H9.6a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h9.8a.6.6 0 0 1 .6.6v9.8a.6.6 0 0 1-.6.6" />
                                        <path
                                            d="M15 9V4.6a.6.6 0 0 0-.6-.6H4.6a.6.6 0 0 0-.6.6v9.8a.6.6 0 0 0 .6.6H9" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Konten Tutorial -->
                <div class="tutorial-article-content">
                    <!-- Langkah 1 -->
                    <div class="tutorial-step">
                        <h4>
                            <span class="step-number">1</span>
                            Persiapan Awal
                        </h4>

                        <!-- Placeholder untuk gambar yang bisa diupload via CMS -->
                        <div class="tutorial-step-image-placeholder">
                            <div>
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>Gambar Persiapan Awal</div>
                                <small>(Upload via CMS)</small>
                            </div>
                        </div>

                        <!-- Jika sudah ada gambar dari CMS, gunakan ini: -->
                        <!-- <img src="{{ $step1_image ?? asset('assets/img/tutorial/step1-placeholder.png') }}"
         alt="Persiapan Awal"
         class="tutorial-step-image" /> -->

                        <p>
                            Sebelum memulai proses penggantian email, pastikan Anda telah menyiapkan semua dokumen yang
                            diperlukan dan memiliki akses ke sistem informasi PUSTIPD. Login menggunakan akun lama Anda
                            terlebih dahulu.
                        </p>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="tutorial-step">
                        <h4>
                            <span class="step-number">2</span>
                            Akses Menu Pengaturan Profil
                        </h4>

                        <!-- Placeholder untuk gambar -->
                        <div class="tutorial-step-image-placeholder">
                            <div>
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>Gambar Menu Pengaturan</div>
                                <small>(Upload via CMS)</small>
                            </div>
                        </div>

                        <!-- Contoh dengan gambar aktual: -->
                        <!-- <img src="{{ $step2_image ?? asset('assets/img/tutorial/step2-placeholder.png') }}"
         alt="Menu Pengaturan Profil"
         class="tutorial-step-image" /> -->

                        <p>
                            Setelah berhasil login, navigasikan ke menu "Pengaturan" atau "Profile Settings" yang
                            biasanya
                            terletak di pojok kanan atas dashboard. Klik pada menu tersebut untuk membuka halaman
                            pengaturan akun.
                        </p>
                    </div>

                    <!-- Tutorial Tip tetap sama -->
                    <div class="tutorial-tip">
                        <div class="tutorial-tip-content">
                            <strong>Tips Penting:</strong> Pastikan email baru yang akan Anda gunakan masih aktif dan
                            dapat menerima email verifikasi. Disarankan menggunakan email institusi (.ac.id) untuk
                            kemudahan akses layanan kampus.
                        </div>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="tutorial-step">
                        <h4>
                            <span class="step-number">3</span>
                            Ubah Alamat Email
                        </h4>

                        <div class="tutorial-step-image-placeholder">
                            <div>
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>Gambar Ubah Email</div>
                                <small>(Upload via CMS)</small>
                            </div>
                        </div>

                        <p>
                            Pada halaman pengaturan profil, cari bagian "Alamat Email" atau "Email Address". Klik tombol
                            "Edit" atau "Ubah", kemudian masukkan alamat email baru Anda. Pastikan alamat email yang
                            dimasukkan sudah benar dan tidak ada kesalahan pengetikan.
                        </p>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="tutorial-step">
                        <h4>
                            <span class="step-number">4</span>
                            Verifikasi Email Baru
                        </h4>

                        <div class="tutorial-step-image-placeholder">
                            <div>
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>Gambar Verifikasi Email</div>
                                <small>(Upload via CMS)</small>
                            </div>
                        </div>

                        <p>
                            Setelah menyimpan perubahan, sistem akan mengirimkan email verifikasi ke alamat email baru
                            Anda. Buka email tersebut dan klik link verifikasi yang diberikan. Proses ini penting untuk
                            mengaktifkan email baru dalam sistem.
                        </p>
                    </div>

                    <!-- Langkah 5 -->
                    <div class="tutorial-step">
                        <h4>
                            <span class="step-number">5</span>
                            Konfirmasi Perubahan
                        </h4>

                        <div class="tutorial-step-image-placeholder">
                            <div>
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>Gambar Konfirmasi</div>
                                <small>(Upload via CMS)</small>
                            </div>
                        </div>

                        <p>
                            Setelah berhasil memverifikasi email baru, kembali ke sistem dan pastikan alamat email telah
                            berubah. Coba logout dan login kembali menggunakan email baru untuk memastikan proses
                            penggantian berhasil dilakukan.
                        </p>
                    </div>

                    <div class="tutorial-tip">
                        <div class="tutorial-tip-content">
                            <strong>Perhatian:</strong> Jika mengalami kendala dalam proses penggantian email, jangan
                            ragu
                            untuk menghubungi tim PUSTIPD melalui kontak yang tersedia di bawah ini.
                        </div>
                    </div>

                    <p
                        style="margin-top:2rem; text-align: center; padding: 1.5rem; background: #f8fafc; border-radius: 1rem; border: 2px solid #e2e8f0;">
                        <strong>Butuh bantuan lebih lanjut?</strong><br>
                        Hubungi tim PUSTIPD di
                        <a href="mailto:pustipd@uinradenfatah.ac.id"
                            class="text-secondary underline font-semibold hover:text-custom-blue">
                            pustipd@uinradenfatah.ac.id
                        </a>
                        atau kunjungi kantor kami di Gedung Perpustakaan Lt. 4 Kampus B Jakabaring
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
            return document.getElementById('judul-tutorial')?.innerText || 'Tutorial Penggantian Email';
        }

        function shareTo(platform) {
            var judul = getDummyTitle();
            var url = window.location.href;
            var shareText = "Tutorial dari PUSTIPD UIN RF Palembang - " + judul + " " + url;

            if (platform === 'wa') {
                window.open('https://wa.me/?text=' + encodeURIComponent(shareText), '_blank');
            }
            if (platform === 'fb') {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Tutorial Berguna dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'ig') {
                window.open('https://www.instagram.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&quote=' +
                    encodeURIComponent("Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
            if (platform === 'tg') {
                window.open('https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' +
                    encodeURIComponent("Tutorial Berguna dari PUSTIPD UIN RF Palembang - " + judul), '_blank');
            }
        }

        function copyTutorialLink() {
            var judul = getDummyTitle();
            var url = window.location.href;
            var hasil = "Tutorial Berguna dari PUSTIPD UIN RF Palembang - " + judul + " " + url;
            navigator.clipboard.writeText(hasil).then(function() {
                alert('Link tutorial telah disalin!');
            });
        }
    </script>
</x-public.layouts>
