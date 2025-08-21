<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="py-20 bg-primary">
        <!-- Pengumuman Section -->
        <div class="container mx-auto px-10 sm:px-20 m-4">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Pengumuman
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Pengumuman terbaru seputar PUSTIPD
                </h3>
            </div>

            <!-- Search Form -->
            <form action="{{ route('announcements') }}" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari Pengumuman di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
                           text-secondary placeholder-gray-400
                           bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
                           focus:outline-none" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-secondary">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                    </svg>
                </button>
            </form>

            {{-- Announcement Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 announcement-grid mt-6">
                @forelse ($announcementsList as $announcement)
                    <x-announcement-card :urgency="$announcement->urgency" :category="$announcement->category" :title="$announcement->title" :excerpt="$announcement->excerpt ?? Str::limit(strip_tags($announcement->content), 140)"
                        :date="$announcement->date ? $announcement->date->format('d F Y') : '-'" :link="route('announcements-detail', $announcement->slug)" />
                @empty
                    <div class="col-span-full text-center py-10 text-gray-600">
                        Tidak ada pengumuman ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <x-pagination :paginator="$announcementsList" />
        </div>
    </section>

</x-public.layouts>
