<x-admin.layouts>
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
                        <p class="text-2xl font-bold text-gray-900" id="total-berita">{{ $totalBerita }}</p>
                        <p class="text-sm text-green-600">+{{ $beritaMingguan }} minggu ini</p>
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
                        <p class="text-2xl font-bold text-gray-900" id="total-dokumen">{{ $totalDokumen }}</p>
                        <p class="text-sm text-blue-600">{{ $dokumenBaru }} dokumen baru</p>
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
                        <p class="text-2xl font-bold text-gray-900" id="total-pengumuman">{{ $totalPengumuman }}</p>
                        <p class="text-sm text-orange-600">{{ $pengumumanUrgent }} urgent</p>
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
                        <p class="text-2xl font-bold text-gray-900" id="visitors-today">
                            {{ number_format($visitorsToday) }}</p>
                        <p class="text-sm text-green-600">{{ $visitorsGrowth }} dari kemarin</p>
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

                <!-- Grid untuk Quick Actions dengan 3 kolom -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

                    <!-- BERANDA -->
                    <!-- Kelola Pencapaian -->
                    <a href="{{ route('admin.beranda.pencapaian.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-emerald-700">
                                Kelola Pencapaian
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Mitra -->
                    <a href="{{ route('admin.beranda.mitra.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-pink-50 hover:border-pink-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center group-hover:bg-pink-200 transition-colors">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-pink-700">
                                Kelola Mitra
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Layanan -->
                    <a href="{{ route('admin.beranda.layanan.index') }}"
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
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-purple-700">
                                Kelola Layanan
                            </span>
                        </div>
                    </a>

                    <!-- TENTANG KAMI -->
                    <!-- Kelola Profil -->
                    <a href="{{ route('admin.tentang-kami.profil.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-slate-50 hover:border-slate-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center group-hover:bg-slate-200 transition-colors">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-slate-700">
                                Kelola Profil
                            </span>
                        </div>
                    </a>

                    <!-- Gallery -->
                    <a href="{{ route('admin.tentang-kami.gallery.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-violet-50 hover:border-violet-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="ml-2 text-sm font-medium text-gray-700 group-hover:text-violet-700">
                                Gallery
                            </span>
                        </div>
                    </a>

                    <!-- Visi Misi -->
                    <a href="{{ route('admin.tentang-kami.visi-misi.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-amber-50 hover:border-amber-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-amber-700">
                                Visi  Misi
                            </span>
                        </div>
                    </a>

                    <!-- Struktur Organisasi -->
                    <a href="{{ route('admin.tentang-kami.struktur-organisasi.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-lime-50 hover:border-lime-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-lime-100 rounded-lg flex items-center justify-center group-hover:bg-lime-200 transition-colors">
                                <svg class="w-4 h-4 text-lime-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-lime-700">
                                Struktur Organisasi
                            </span>
                        </div>
                    </a>

                    <!-- APLIKASI & LAYANAN -->
                    <!-- Aplikasi & Layanan -->
                    <a href="{{ route('admin.app-layanan.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-sky-50 hover:border-sky-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-sky-700">
                                App & Layanan
                            </span>
                        </div>
                    </a>

                    <!-- INFORMASI TERKINI -->
                    <!-- Kelola Berita -->
                    <a href="{{ route('admin.informasi-terkini.kelola-berita.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-blue-700">
                                Kelola Berita
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Pengumuman -->
                    <a href="{{ route('admin.informasi-terkini.kelola-pengumuman.index') }}"
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
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-green-700">
                                Kelola Pengumuman
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Tutorial -->
                    <a href="{{ route('admin.informasi-terkini.kelola-tutorial.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-indigo-700">
                                Kelola Tutorial
                            </span>
                        </div>
                    </a>

                    <!-- DOKUMEN & REGULASI -->
                    <!-- Kelola Ketetapan -->
                    <a href="{{ route('admin.dokumen.ketetapan.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-red-700">
                                Kelola Ketetapan
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Panduan -->
                    <a href="{{ route('admin.dokumen.panduan.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-teal-50 hover:border-teal-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-teal-700">
                                Kelola  Panduan
                            </span>
                        </div>
                    </a>

                    <!-- Kelola Regulasi -->
                    <a href="{{ route('admin.dokumen.regulasi.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-yellow-50 hover:border-yellow-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition-colors">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-yellow-700">
                                Kelola Regulasi
                            </span>
                        </div>
                    </a>

                    <!-- Kelola SOP -->
                    <a href="{{ route('admin.dokumen.sop.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-cyan-50 hover:border-cyan-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center group-hover:bg-cyan-200 transition-colors">
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-cyan-700">
                                Kelola SOP
                            </span>
                        </div>
                    </a>                    

                    <!-- FAQ -->
                    <a href="{{ route('admin.faq.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-rose-50 hover:border-rose-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center group-hover:bg-rose-200 transition-colors">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-rose-700">
                                FAQ
                            </span>
                        </div>
                    </a>

                    <!-- SISTEM -->
                    <!-- Kelola User -->
                    <a href="{{ route('admin.sistem.manage-users.index') }}"
                        class="p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-300 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-orange-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-orange-700">
                                Kelola User
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Link untuk Lihat Semua -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 text-center">
                        Total <span class="font-semibold text-blue-600">17</span> menu manajemen tersedia
                    </p>
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
                <div class="space-y-3" id="recent-activities">
                    @foreach ($recentActivities as $activity)
                        <div class="flex items-start space-x-3 p-3 bg-{{ $activity['color'] }}-50 rounded-lg">
                            <div class="w-2 h-2 bg-{{ $activity['color'] }}-500 rounded-full mt-2 flex-shrink-0">
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $activity['message'] }}</p>
                                <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Bottom Section -->
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
                        <span
                            class="text-sm font-medium text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ $contentStatus['draft'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Published</span>
                        <span
                            class="text-sm font-medium text-green-700 bg-green-100 px-2 py-1 rounded">{{ $contentStatus['published'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Scheduled</span>
                        <span
                            class="text-sm font-medium text-blue-700 bg-blue-100 px-2 py-1 rounded">{{ $contentStatus['scheduled'] }}</span>
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
                <div class="space-y-3" id="system-health">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Database</span>
                        <span
                            class="flex items-center text-sm font-medium text-{{ $systemHealth['database']['color'] }}-700">
                            <span
                                class="w-2 h-2 bg-{{ $systemHealth['database']['color'] }}-500 rounded-full mr-2 animate-pulse"></span>
                            {{ $systemHealth['database']['status'] }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Server</span>
                        <span class="flex items-center text-sm font-medium text-green-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            {{ $systemHealth['server'] }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Storage</span>
                        <span
                            class="flex items-center text-sm font-medium text-{{ $systemHealth['storage']['color'] }}-700">
                            <span
                                class="w-2 h-2 bg-{{ $systemHealth['storage']['color'] }}-500 rounded-full mr-2"></span>
                            {{ $systemHealth['storage']['percentage'] }} Used
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Backup</span>
                        <span
                            class="flex items-center text-sm font-medium text-{{ $systemHealth['backup']['color'] }}-700">
                            <span
                                class="w-2 h-2 bg-{{ $systemHealth['backup']['color'] }}-500 rounded-full mr-2"></span>
                            {{ $systemHealth['backup']['status'] }}
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
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">•
                        Pengaturan SEO</a>
                    <a href="{{ route('admin.faq.index') }}"
                        class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">• Kelola FAQ</a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">• Backup
                        & Maintenance</a>
                    <a href="#" class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">•
                        Dokumentasi API</a>
                    <a href="https://pustipd.radenfatah.ac.id/" target="_blank"
                        class="block text-sm text-blue-600 hover:text-blue-700 hover:underline">• Website PUSTIPD →</a>
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

    <!-- Real-time Update Script -->
    <script>
        // Real-time updates every 30 seconds
        setInterval(function() {
            fetch(`{{ route('admin.dashboard.realtime') }}`)
                .then(response => response.json())
                .then(data => {
                    // Update statistics
                    document.getElementById('total-berita').textContent = data.totalBerita;
                    document.getElementById('total-dokumen').textContent = data.totalDokumen;
                    document.getElementById('total-pengumuman').textContent = data.totalPengumuman;
                    document.getElementById('visitors-today').textContent = data.visitorsToday.toLocaleString();

                    // Update recent activities
                    updateRecentActivities(data.recentActivities);

                    // Update system health
                    updateSystemHealth(data.systemHealth);
                })
                .catch(error => console.log('Error updating dashboard:', error));
        }, 30000); // 30 seconds

        function updateRecentActivities(activities) {
            const container = document.getElementById('recent-activities');
            container.innerHTML = '';

            activities.forEach(activity => {
                const activityHTML = `
                    <div class="flex items-start space-x-3 p-3 bg-${activity.color}-50 rounded-lg">
                        <div class="w-2 h-2 bg-${activity.color}-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">${activity.message}</p>
                            <p class="text-xs text-gray-500">${activity.time}</p>
                        </div>
                    </div>
                `;
                container.innerHTML += activityHTML;
            });
        }

        function updateSystemHealth(health) {
            const container = document.getElementById('system-health');
            // Update database status
            const dbStatus = container.querySelector('.database-status');
            if (dbStatus) {
                dbStatus.className = `flex items-center text-sm font-medium text-${health.database.color}-700`;
                dbStatus.innerHTML = `
                    <span class="w-2 h-2 bg-${health.database.color}-500 rounded-full mr-2 animate-pulse"></span>
                    ${health.database.status}
                `;
            }
        }

        // Page load animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.bg-white');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';

                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });
    </script>
</x-admin.layouts>
