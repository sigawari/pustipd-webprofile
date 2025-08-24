<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <x-modalnews :urgentAnnouncements="$urgentAnnouncements" />
    <section id="beranda"
        class="relative bg-blue-950 text-amber-50 min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <img src="{{ asset('assets/img/hero/img-02.jpg') }}" alt="Hero Image"
            class="absolute inset-0 w-full h-full object-cover opacity-40">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black via-secondary to-navy-700 opacity-70"></div>

        <div class="relative z-10 text-center px-4 sm:px-6 w-full max-w-2xl">
            <h1 class="text-2xl sm:text-6xl font-extrabold mb-3 leading-snug sm:leading-tight">
                {{ $profil->organization_name ?? 'Pusat Teknologi Informasi dan Pangkalan Data' }}
            </h1>

            <!-- h2 with logo -->
            <span
                class="text-sm sm:text-lg font-medium mb-6 flex items-center justify-center gap-2 flex-wrap text-white">
                <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="Logo UINRF" class="h-4 sm:h-6">
                <h2 class="text-l sm:text-xl font-bold text-white">UIN Raden Fatah Palembang</h2>
            </span>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari informasi di sini"
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 text-white placeholder-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-white">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z"></path>
                    </svg>
                </button>
            </form>

            <!-- Floating Buttons BELOW Hero -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <!-- Left Button -->
                <a href="https://survei.radenfatah.ac.id/" target="_blank"
                    class="bg-white text-custom-yellow font-medium px-4 py-2 rounded-full shadow-md flex items-center justify-center gap-2 transition transform hover:scale-105 hover:bg-custom-yellow hover:text-white w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3l1-2h4l1 2h3a2 2 0 012 2v11a2 2 0 01-2 2z" />
                    </svg>
                    <h4 class="font-bold">Isi Survei</h4>
                </a>

                <!-- Right Button -->
                <a href="https://t.me/pustipd_bot" target="_blank"
                    class="bg-white text-secondary font-medium px-4 py-2 rounded-full shadow-md flex items-center justify-center gap-2 transition transform hover:scale-105 hover:bg-secondary hover:text-white w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8h3l4-4V6a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h1v4l4-4z" />
                    </svg>
                    <h4 class="font-bold">Tanya PUSTIPD</h4>
                </a>
            </div>
        </div>
    </section>

    <!-- Pencapaian Section -->
    <section id="pencapaian" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Pencapaian
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Beberapa pencapaian UIN Raden Fatah Palembang dan PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            @if ($achievements && $achievements->count() > 0)
                @php
                    // Konversi collection ke array untuk processing
                    $achievementsArray = $achievements
                        ->map(function ($achievement) {
                            return [
                                'title' => $achievement->name,
                                'description' => $achievement->description ?: 'Tidak ada deskripsi', // Fallback jika kosong
                            ];
                        })
                        ->toArray();

                    // Debug hasil mapping - uncomment untuk cek
                    // dd($achievementsArray);

                    $slidesDesktop = array_chunk($achievementsArray, 5);
                    $slidesMobile = array_chunk($achievementsArray, 1);
                @endphp

                <!-- Achievement Carousel Container -->
                <div class="achievement-carousel max-w-6xl mx-auto"
                    data-total-slides-desktop="{{ count($slidesDesktop) }}"
                    data-total-slides-mobile="{{ count($slidesMobile) }}" data-duration="4000">

                    <div class="relative overflow-hidden">
                        <!-- Desktop Carousel Track -->
                        <div
                            class="achievement-carousel-track-desktop hidden lg:flex transition-transform duration-500 ease-in-out">
                            @foreach ($slidesDesktop as $slideIndex => $slideCards)
                                <div class="w-full flex-shrink-0">
                                    <div class="flex flex-wrap justify-center gap-6">
                                        @foreach ($slideCards as $achievement)
                                            <div class="achievement-card-wrapper">
                                                <x-achievement-card :title="$achievement['title']" :description="$achievement['description'] ?? ''" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile Carousel Track -->
                        <div
                            class="achievement-carousel-track-mobile flex lg:hidden transition-transform duration-500 ease-in-out">
                            @foreach ($slidesMobile as $slideIndex => $slideCards)
                                <div class="w-full flex-shrink-0">
                                    <div class="flex justify-center">
                                        @foreach ($slideCards as $achievement)
                                            <div class="achievement-card-wrapper w-full max-w-xs">
                                                <x-achievement-card :title="$achievement['title']" :description="$achievement['description'] ?? ''" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Desktop Indicators -->
                    <div class="hidden lg:flex justify-center mt-8 space-x-3">
                        @foreach ($slidesDesktop as $index => $slide)
                            <button
                                class="achievement-indicator-desktop w-3 h-3 rounded-full transition-all duration-300 bg-secondary hover:bg-custom-blue hover:scale-110">
                            </button>
                        @endforeach
                    </div>

                    <!-- Mobile Indicators -->
                    <div class="flex lg:hidden justify-center mt-8 space-x-3">
                        @foreach ($slidesMobile as $index => $slide)
                            <button
                                class="achievement-indicator-mobile w-3 h-3 rounded-full transition-all duration-300 bg-secondary hover:bg-custom-blue hover:scale-110">
                            </button>
                        @endforeach
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-4 overflow-hidden">
                        <div class="achievement-progress-bar bg-secondary h-1 rounded-full transition-all duration-100 ease-linear"
                            style="width: 0%"></div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada pencapaian yang dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-[#E6F6FF]">
        <div class="max-w-7xl mx-auto px-10">
            <div class="text-center mb-8 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Layanan Kami
                </h2>
            </div>

            <!-- Carousel Container -->
            <div class="overflow-hidden">
                <!-- Carousel Wrapper dengan padding minimal -->
                <div class="px-1" id="servicesCarousel">
                    <div class="transition-transform duration-200 ease-in-out" id="carouselWrapper">
                        <!-- Gunakan flex dengan justify-center -->
                        <div class="flex justify-center items-stretch gap-4 min-h-[200px]">
                            @if ($services && $services->count() > 0)
                                @foreach ($services as $service)
                                    <div class="flex-shrink-0 w-full max-w-sm">
                                        <x-service-card :title="$service->name" :description="$service->description" />
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback jika tidak ada data -->
                                <div class="w-full text-center py-12">
                                    <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-center items-center mt-1 space-x-2 relative z-10"
                    aria-label="Carousel Navigation">
                    <div class="flex space-x-2" id="indicators" aria-label="Carousel Indicators">
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mt-3 px-4">
                    <div class="w-full bg-gray-200 rounded-full h-1">
                        <div class="bg-primary h-1 rounded-full transition-all duration-150 ease-out" 
                            style="--w: {{ $services->count() > 0 ? 100 / $services->count() : 100 }}%; width: var(--w);">
                        </div>
                        <!-- <div class="bg-primary h-1 rounded-full transition-all duration-150 ease-out" id="progressBar"
                            style="width: {{ $services->count() > 0 ? 100 / $services->count() : 100 }}%">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Berita Pengumuman Section -->
    <section id="informasi" class="py-20 bg-primary">
        <div class="container mx-auto px-6">
            {{-- Header Section --}}
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Berita dan Informasi
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Update terbaru seputar berita dan pengumuman penting dari kami
                </h3>
            </div>

            {{-- Content Container --}}
            <div class="max-w-7xl mx-auto">
                {{-- Berita Section --}}
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-secondary">Berita Terbaru</h3>
                        <a href="/berita"
                            class="text-secondary hover:text-custom-blue font-medium flex items-center group">
                            Lihat Semua Berita
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- Mobile Section --}}
                    <div class="lg:hidden space-y-4">
                        @if ($newsList->count() > 0)
                            @php $firstNews = $newsList->first(); @endphp
                            <x-news-card title="{{ $firstNews->name }}"
                                excerpt="{{ Str::limit(strip_tags($firstNews->content), 140) }}"
                                date="{{ $firstNews->publish_date ? \Carbon\Carbon::parse($firstNews->publish_date)->format('d F Y') : '-' }}"
                                category="{{ ucfirst(str_replace('_', ' ', $firstNews->category)) }}"
                                link="{{ route('news-detail', $firstNews->slug) }}"
                                image="{{ $firstNews->image ? asset('storage/' . $firstNews->image) : asset('assets/img/placeholder/dummy.png') }}" />
                        @endif

                        @foreach ($newsList->slice(1) as $news)
                            <div class="bg-white rounded-lg border border-gray-200 p-3">
                                <div class="font-bold text-gray-900 mb-1 text-sm truncate">{{ $news->name }}</div>
                                <div class="text-gray-600 text-xs mb-2 line-clamp-2">
                                    {{ Str::limit(strip_tags($news->content), 100) }}</div>
                                <a href="{{ route('news-detail', $news->slug) }}"
                                    class="text-blue-600 font-semibold text-xs flex items-center">
                                    Selanjutnya
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Desktop Section --}}
                    <div class="hidden lg:grid grid-cols-2 lg:grid-cols-3 gap-8 news-grid">
                        @forelse ($newsList as $news)
                            <x-news-card title="{{ $news->name }}"
                                excerpt="{{ Str::limit(strip_tags($news->content), 140) }}"
                                date="{{ $news->publish_date ? \Carbon\Carbon::parse($news->publish_date)->format('d F Y') : '-' }}"
                                category="{{ ucfirst(str_replace('_', ' ', $news->category)) }}"
                                link="{{ route('news-detail', $news->slug) }}"
                                image="{{ $news->image ? asset('storage/' . $news->image) : asset('assets/img/placeholder/dummy.png') }}" />
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10 text-gray-600">
                                Tidak ada berita ditemukan.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Pengumuman Section --}}
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-secondary">Pengumuman Penting</h3>
                        <a href="{{ route('announcements') }}"
                            class="text-secondary hover:text-custom-blue font-medium flex items-center group">
                            Lihat Semua Pengumuman
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- Mobile Section --}}
                    <div class="lg:hidden space-y-3">
                        @forelse ($announcementsList as $announcement)
                            <div
                                class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-3">
                                <div class="font-medium text-gray-900 text-sm truncate">{{ $announcement->title }}
                                </div>
                                <a href="{{ route('announcements-detail', $announcement->slug) }}"
                                    class="ml-4 text-custom-blue font-semibold text-sm flex items-center">
                                    <span class="sr-only">Lihat Detail</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                Tidak ada pengumuman tersedia.
                            </div>
                        @endforelse
                    </div>

                    {{-- Desktop Section --}}
                    <div class="hidden lg:grid grid-cols-2 lg:grid-cols-3 gap-8 announcement-grid">
                        @forelse ($announcementsList as $announcement)
                            <x-announcement-card :urgency="$announcement->urgency" :category="$announcement->category" :title="$announcement->title"
                                :excerpt="$announcement->excerpt ??
                                    Str::limit(strip_tags($announcement->content), 140)" :date="$announcement->date ? $announcement->date->format('d F Y') : '-'" :link="route('announcements-detail', $announcement->slug)" />
                        @empty
                            <div class="col-span-full text-center py-10 text-gray-600">
                                Tidak ada pengumuman tersedia.
                            </div>
                        @endforelse
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Tim Section dengan Infinite Carousel -->
    <section id="tentang" class="py-15 bg-white overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Tim PUSTIPD
                </h2>
                <h3 class="text-xl text-secondary max-w-2xl mx-auto pt-2">
                    Tim profesional yang berdedikasi untuk memberikan layanan terbaik
                </h3>
            </div>

            @if (!empty($teams) && $teams->count() > 0)
                <!-- Infinite Carousel -->
                <div class="container mx-auto px-6 max-w-8-full">
                    <!-- Carousel Track -->
                    <div class="flex animate-infinite-scroll gap-2 sm:gap-4 md:gap-5" id="teamCarousel">
                        <!-- First Set of Cards - Dynamic -->
                        @foreach ($teams as $member)
                            <x-team-card :nama="$member->nama" :jabatan="$member->jabatan" :foto="$member->foto
                                ? asset('storage/' . $member->foto)
                                : asset('assets/img/placeholder/dummy.png')" :email="$member->email ?? ''" />
                        @endforeach
                        @foreach ($teams as $member)
                            <x-team-card :nama="$member->nama" :jabatan="$member->jabatan" :foto="$member->foto
                                ? asset('storage/' . $member->foto)
                                : asset('assets/img/placeholder/dummy.png')" :email="$member->email ?? ''" />
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-10">
                    <div class="max-w-md mx-auto">
                        <div class="flex justify-center mb-6">
                            <div class="bg-gray-100 p-6 rounded-full">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 mb-3">
                            Tim Sedang Dalam Penyusunan
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Informasi lengkap tentang tim PUSTIPD akan segera tersedia.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <!-- Mitra Section dengan Grid -->
    <section id="mitra" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6 max-w-8-full">
            <!-- Judul -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Mitra Kami
                </h2>
            </div>

            @if ($partners && $partners->count() > 0)
                <div class="relative overflow-hidden w-full">
                    <div class="flex animate-infinite-scroll gap-2" id="mitraCarousel">
                        @foreach ($partners as $mitra)
                            <x-partner-card :name="$mitra->name" :logo="$mitra->image
                                ? Storage::url($mitra->image)
                                : asset('assets/img/placeholder/dummy.png')" />
                        @endforeach
                        @foreach ($partners as $mitra)
                            <x-partner-card :name="$mitra->name" :logo="$mitra->image
                                ? Storage::url($mitra->image)
                                : asset('assets/img/placeholder/dummy.png')" />
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada mitra yang dipublikasikan.</p>
                </div>
            @endif

        </div>
    </section>

</x-public.layouts>
