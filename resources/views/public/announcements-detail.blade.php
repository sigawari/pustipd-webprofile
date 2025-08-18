<x-public.layouts :title="$title" :description="$description" :keywords="$keywords">
    <x-slot:title>{{ $title }}</x-slot:title>

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

                <!-- Dynamic Title -->
                <h1 class="announcement-title-detail" id="judul-pengumuman">{{ $announcement->title }}</h1>

                <!-- Date and Category -->
                <div class="announcement-date-cat mb-2 text-center">
                    {{ ucfirst($announcement->category) }} &middot;
                    <span>{{ \Carbon\Carbon::parse($announcement->publish_date)->format('d F Y') }}</span>
                </div>

                <!-- Priority Badge -->
                @if ($announcement->isUrgent())
                    <div class="mb-4 text-center"> <!-- tambahkan text-center di sini -->
                        <div class="priority-badge urgent-badge inline-flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            URGENT - Pengumuman Penting
                        </div>
                    </div>
                @endif

                <!-- Share Button Component -->
                <x-share-buttons :url="$url" :share-text="$shareText" />

                <!-- Announcement Content -->
                <div class="announcement-article-content">
                    {!! $announcement->content !!}
                </div>

                <!-- Expiry Notice: Conditionally render if date exists -->
                @if ($announcement->valid_until)
                    <div class="expiry-notice">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <strong>Batas Waktu Pengumuman:</strong>
                            {{ \Carbon\Carbon::parse($announcement->valid_until)->format('d F Y, H:i') }}
                            <br>
                            <small>Pengumuman ini akan otomatis dihapus setelah tanggal tersebut</small>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
</x-public.layouts>
