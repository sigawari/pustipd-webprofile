<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

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

        /* Tab Navigation Styles */
        .tab-navigation {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 0.5rem;
            box-shadow: 0 8px 32px rgba(6, 39, 73, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .tab-item {
            position: relative;
            padding: 1rem 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #6b7280;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .tab-item:hover {
            color: #062749;
            background: rgba(6, 39, 73, 0.05);
            transform: translateY(-1px);
        }

        .tab-item.active {
            color: #fff;
            background: #062749;
            box-shadow: 0 4px 15px rgba(6, 39, 73, 0.3);
            transform: translateY(-2px);
        }

        .tab-item.active::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #062749;
        }

        /* Content Sections */
        .tab-content {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Document Cards */
        .document-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(6, 39, 73, 0.08);
            border: 1px solid rgba(6, 39, 73, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .document-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #062749;
        }

        .document-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(6, 39, 73, 0.15);
        }

        .download-btn {
            background: #062749;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .download-btn:hover {
            background: #82BEE0;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 39, 73, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tab-navigation {
                overflow-x: auto;
                padding: 0.5rem 0.25rem;
            }

            .tab-item {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                min-width: max-content;
            }

            .tab-navigation::-webkit-scrollbar {
                height: 4px;
            }

            .tab-navigation::-webkit-scrollbar-track {
                background: transparent;
            }

            .tab-navigation::-webkit-scrollbar-thumb {
                background: rgba(6, 39, 73, 0.3);
                border-radius: 2px;
            }
        }
    </style>

    <section id="public-info" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Dokumen
                </h2>
                <h3 class="text-lg text-secondary pt-4">
                    Informasi Publik dan dokumen terkait PUSTIPD yang bisa diunduh
                </h3>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                <input type="text" name="search" placeholder="Cari dokumen di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
                   text-secondary placeholder-gray-400
                   bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
                   focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-secondary">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                    </svg>
                </button>
            </form>

            <!-- Tab Navigation -->
            <div class="max-w-3xl mx-auto mb-8">
                <div class="tab-navigation">
                    <div class="flex flex-wrap md:flex-nowrap gap-2 justify-center">
                        <a href="#" class="tab-item" data-tab="ketetapan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Ketetapan
                        </a>
                        <a href="#" class="tab-item" data-tab="panduan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Panduan
                        </a>
                        <a href="#" class="tab-item" data-tab="regulasi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2m-6 4h6" />
                            </svg>
                            Regulasi
                        </a>
                        <a href="#" class="tab-item" data-tab="sop">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h6a2 2 0 002-2V7a2 2 0 00-2-2h-2m0 0V3a2 2 0 00-2-2H9a2 2 0 00-2 2v2z" />
                            </svg>
                            SOP
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tab Contents -->
            <div class="max-w-4xl mx-auto">
                <!-- Ketetapan Tab Content -->
                <div id="ketetapan" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="document-card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Laporan Tahunan 2024</h4>
                                        <p class="text-sm text-gray-500">PDF • 12.3 MB</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                Laporan komprehensif kegiatan dan pencapaian PUSTIPD selama tahun 2024.
                            </p>
                            <button class="download-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Panduan Tab Content -->
                <div id="panduan" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="document-card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Panduan Pengguna Sistem</h4>
                                        <p class="text-sm text-gray-500">PDF • 5.4 MB</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                Panduan lengkap penggunaan sistem informasi PUSTIPD untuk mahasiswa dan dosen.
                            </p>
                            <button class="download-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Regulasi Tab Content -->
                <div id="regulasi" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="document-card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2m-6 4h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Regulasi IT Governance</h4>
                                        <p class="text-sm text-gray-500">PDF • 3.2 MB</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                Dokumen regulasi tata kelola teknologi informasi di lingkungan UIN Raden Fatah
                                Palembang.
                            </p>
                            <button class="download-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SOP Tab Content -->
                <div id="sop" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="document-card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h6a2 2 0 002-2V7a2 2 0 00-2-2h-2m0 0V3a2 2 0 00-2-2H9a2 2 0 00-2 2v2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">SOP Layanan IT</h4>
                                        <p class="text-sm text-gray-500">PDF • 4.1 MB</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                Standard Operating Procedure untuk seluruh layanan teknologi informasi PUSTIPD.
                            </p>
                            <button class="download-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabItems = document.querySelectorAll('.tab-item');
            const tabContents = document.querySelectorAll('.tab-content');

            tabItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all tabs and contents
                    tabItems.forEach(tab => tab.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Download functionality
            const downloadBtns = document.querySelectorAll('.download-btn');
            downloadBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Add your download logic here
                    alert('Download started!');
                });
            });
        });
    </script>
</x-public.layouts>
