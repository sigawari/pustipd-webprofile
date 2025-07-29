<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error - PUSTIPD UIN Raden Fatah</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .error-container {
                background: #f8fafc;
                min-height: 100vh;
                position: relative;
                overflow: hidden;
            }

            .error-card {
                background: #fff;
                border-radius: 1.5rem;
                box-shadow: 0 20px 60px rgba(6, 39, 73, 0.15);
                border: 1px solid rgba(6, 39, 73, 0.1);
                position: relative;
                overflow: hidden;
            }

            .error-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 6px;
                background: #062749;
            }

            .error-icon {
                width: 120px;
                height: 120px;
                background: rgba(6, 39, 73, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 2rem auto;
                border: 3px solid rgba(6, 39, 73, 0.2);
                animation: pulse-soft 3s ease-in-out infinite;
            }

            .error-icon svg {
                color: #062749;
                width: 60px;
                height: 60px;
            }

            .error-title {
                color: #062749;
                font-size: 2.5rem;
                font-weight: 800;
                text-align: center;
                margin-bottom: 1rem;
                letter-spacing: -0.025em;
            }

            .error-subtitle {
                color: #4671af;
                font-size: 1.25rem;
                font-weight: 600;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .error-message {
                color: #64748b;
                font-size: 1.1rem;
                line-height: 1.7;
                text-align: center;
                margin-bottom: 2.5rem;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
            }

            .error-actions {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn-primary {
                background: #062749;
                color: white;
                padding: 1rem 2rem;
                border-radius: 0.75rem;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                border: 2px solid #062749;
                box-shadow: 0 4px 15px rgba(6, 39, 73, 0.3);
            }

            .btn-primary:hover {
                background: #1e40af;
                border-color: #1e40af;
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(6, 39, 73, 0.4);
            }

            .btn-secondary {
                background: transparent;
                color: #062749;
                padding: 1rem 2rem;
                border-radius: 0.75rem;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                border: 2px solid #062749;
            }

            .btn-secondary:hover {
                background: #062749;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(6, 39, 73, 0.3);
            }

            .decoration-element {
                position: absolute;
                opacity: 0.05;
                pointer-events: none;
            }

            .decoration-1 {
                top: 10%;
                left: 10%;
                width: 100px;
                height: 100px;
                background: #062749;
                border-radius: 50%;
                animation: float-1 6s ease-in-out infinite;
            }

            .decoration-2 {
                top: 20%;
                right: 15%;
                width: 80px;
                height: 80px;
                background: #4671af;
                border-radius: 0.5rem;
                transform: rotate(45deg);
                animation: float-2 8s ease-in-out infinite;
            }

            .decoration-3 {
                bottom: 15%;
                left: 15%;
                width: 60px;
                height: 60px;
                background: #82BEE0;
                border-radius: 50%;
                animation: float-3 7s ease-in-out infinite;
            }

            .decoration-4 {
                bottom: 25%;
                right: 10%;
                width: 90px;
                height: 90px;
                background: #062749;
                border-radius: 0.5rem;
                animation: float-1 9s ease-in-out infinite;
            }

            .error-code {
                display: inline-block;
                background: rgba(6, 39, 73, 0.1);
                color: #062749;
                padding: 0.5rem 1rem;
                border-radius: 2rem;
                font-size: 0.875rem;
                font-weight: 600;
                margin-bottom: 2rem;
                border: 1px solid rgba(6, 39, 73, 0.2);
            }

            @keyframes pulse-soft {

                0%,
                100% {
                    transform: scale(1);
                    opacity: 1;
                }

                50% {
                    transform: scale(1.05);
                    opacity: 0.8;
                }
            }

            @keyframes float-1 {

                0%,
                100% {
                    transform: translateY(0px) rotate(0deg);
                }

                50% {
                    transform: translateY(-20px) rotate(180deg);
                }
            }

            @keyframes float-2 {

                0%,
                100% {
                    transform: translateY(0px) rotate(45deg);
                }

                50% {
                    transform: translateY(-15px) rotate(225deg);
                }
            }

            @keyframes float-3 {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-25px);
                }
            }

            .status-indicator {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                margin-bottom: 2rem;
                padding: 1rem;
                background: rgba(239, 68, 68, 0.1);
                border: 1px solid rgba(239, 68, 68, 0.2);
                border-radius: 0.75rem;
                color: #dc2626;
                font-weight: 600;
            }

            .breadcrumb {
                text-align: center;
                margin-bottom: 2rem;
                color: #64748b;
                font-size: 0.875rem;
            }

            .breadcrumb a {
                color: #062749;
                text-decoration: none;
                font-weight: 500;
            }

            .breadcrumb a:hover {
                text-decoration: underline;
            }

            @media (max-width: 640px) {
                .error-title {
                    font-size: 2rem;
                }

                .error-subtitle {
                    font-size: 1.1rem;
                }

                .error-message {
                    font-size: 1rem;
                    padding: 0 1rem;
                }

                .error-actions {
                    flex-direction: column;
                    align-items: center;
                    gap: 0.75rem;
                }

                .btn-primary,
                .btn-secondary {
                    padding: 0.875rem 1.5rem;
                    font-size: 0.95rem;
                    min-width: 200px;
                }
            }
        </style>
    </head>

    <body>
        <div class="error-container">
            <!-- Decorative Elements -->
            <div class="decoration-element decoration-1"></div>
            <div class="decoration-element decoration-2"></div>
            <div class="decoration-element decoration-3"></div>
            <div class="decoration-element decoration-4"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="error-card max-w-2xl w-full p-8 md:p-12">
                    <!-- Breadcrumb -->
                    <div class="breadcrumb">
                        <a href="{{ route('login') }}">Login</a> /
                        <span>Error</span>
                    </div>

                    <!-- Error Icon -->
                    <div class="error-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <!-- Error Code -->
                    <div class="text-center">
                        <span class="error-code">Error Code: AUTH001</span>
                    </div>

                    <!-- Status Indicator -->
                    <div class="status-indicator">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Terjadi Kesalahan Autentikasi</span>
                    </div>

                    <!-- Error Content -->
                    <h1 class="error-title">Oops! Ada Masalah</h1>
                    <h2 class="error-subtitle">Sistem Autentikasi Mengalami Gangguan</h2>

                    <div class="error-message">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            Maaf, terjadi kesalahan pada sistem autentikasi PUSTIPD. Tim kami sedang menangani masalah
                            ini.
                            Silakan coba lagi dalam beberapa saat atau hubungi administrator sistem jika masalah
                            berlanjut.
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="error-actions">
                        <a href="{{ route('login') }}" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Coba Login Lagi
                        </a>

                        <a href="{{ url('/') }}" class="btn-secondary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Additional Help -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-sm text-gray-500 mb-3">
                            Butuh bantuan? Hubungi tim PUSTIPD
                        </p>
                        <div class="flex flex-wrap justify-center gap-4 text-sm">
                            <a href="mailto:pustipd@uinradenfatah.ac.id"
                                class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                pustipd@uinradenfatah.ac.id
                            </a>
                            <span class="text-gray-300">|</span>
                            <span class="text-gray-600">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Gedung Perpustakaan Lt. 4 Kampus B
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Auto refresh untuk development (opsional)
            // setTimeout(() => {
            //     location.reload();
            // }, 30000); // Refresh setiap 30 detik

            // Log error ke console untuk debugging
            console.log('Auth Error Page Loaded:', {
                timestamp: new Date().toISOString(),
                userAgent: navigator.userAgent,
                url: window.location.href
            });
        </script>
    </body>

</html>
