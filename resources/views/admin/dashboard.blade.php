<x-admin.layouts>
    <!-- @section('title', 'Dashboard - PUSTIPD Admin')
    @section('description', 'Dashboard admin untuk sistem manajemen konten PUSTIPD UIN Raden Fatah Palembang')
    @section('keywords', 'dashboard, admin, PUSTIPD, CMS, UIN Raden Fatah') -->

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-6 space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Statistik Card 1 -->
            <div
                class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Berita</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalBerita }}</p>
                        <p class="text-sm text-green-600">+12 minggu ini</p>
                    </div>
                </div>
            </div>

            <!-- Statistik Card 2 -->
            <div
                class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Dokumen</p>
                        <p class="text-2xl font-bold text-gray-900">18</p>
                        <p class="text-sm text-blue-600">3 dokumen baru</p>
                    </div>
                </div>
            </div>

            <!-- Statistik Card 3 -->
            <div
                class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pengumuman Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">7</p>
                        <p class="text-sm text-orange-600">2 urgent</p>
                    </div>
                </div>
            </div>

            <!-- Statistik Card 4 -->
            <div
                class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Visitor Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">1,284</p>
                        <p class="text-sm text-green-600">+15.3% dari kemarin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aksi Cepat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="#"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-blue-700">Buat
                                Berita</span>
                        </div>
                    </a>

                    <a href="#"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="ml-2 text-sm font-medium text-gray-700 group-hover:text-green-700">Pengumuman</span>
                        </div>
                    </a>

                    <a href="#"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-purple-700">Kelola
                                Layanan</span>
                        </div>
                    </a>

                    <a href="#"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-orange-700">Kelola
                                User</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">Berita "Implementasi Sistem Baru" dipublish
                            </p>
                            <p class="text-xs text-gray-500">2 menit yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">3 layanan baru ditambahkan</p>
                            <p class="text-xs text-gray-500">1 jam yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">Pengumuman "Maintenance Server" diperbarui</p>
                            <p class="text-xs text-gray-500">3 jam yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">Backup database berhasil</p>
                            <p class="text-xs text-gray-500">5 jam yang lalu</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Lihat semua aktivitas
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Content Status, System Health, Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Content Status -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Status Konten
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Draft</span>
                        <span class="text-sm font-medium text-gray-900 bg-gray-100 px-2 py-1 rounded">12</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Published</span>
                        <span class="text-sm font-medium text-green-700 bg-green-100 px-2 py-1 rounded">156</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Scheduled</span>
                        <span class="text-sm font-medium text-blue-700 bg-blue-100 px-2 py-1 rounded">3</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Archived</span>
                        <span class="text-sm font-medium text-gray-700 bg-gray-100 px-2 py-1 rounded">74</span>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Kesehatan Sistem
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Database</span>
                        <span class="flex items-center text-sm font-medium text-green-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            Online
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Server</span>
                        <span class="flex items-center text-sm font-medium text-green-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            Normal
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Storage</span>
                        <span class="flex items-center text-sm font-medium text-yellow-700">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                            75% Used
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Backup</span>
                        <span class="flex items-center text-sm font-medium text-green-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Updated
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                        </path>
                    </svg>
                    Link Terkait
                </h3>
                <div class="space-y-2">
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Pengaturan SEO
                    </a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Kelola FAQ
                    </a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Laporan Analytics
                    </a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Backup & Maintenance
                    </a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Dokumentasi API
                    </a>
                    <a href="#" target="_blank"
                        class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">
                        • Website PUSTIPD →
                    </a>
                </div>
            </div>
        </div>

        <!-- Session Actions -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sesi Admin</h3>
                    <p class="text-sm text-gray-600">Kelola sesi dan akses administrator sistem</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                    <a href="#"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center">
                        Pengaturan
                    </a>
                    <form action="{{ route('login.logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm font-medium flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts>
