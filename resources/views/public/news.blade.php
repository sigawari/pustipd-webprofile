<x-public.layouts :title="$title" :description="$description" :keywords="$keywords">
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Berita & Informasi Section -->
    <section class="py-20 bg-primary">
        <div class="container mx-auto px-10 sm:px-20 m-4">

            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4 relative inline-block underline-animate">
                    Berita
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Berita terbaru seputar PUSTIPD
                </h3>
            </div>

            <!-- Content Container -->
            <div class="max-w-6xl mx-auto">

                <!-- Search Form -->
                <form action="{{ route('news') }}" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Berita di sini...."
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

                <!-- Berita Cards Grid - Responsif: 1 kolom mobile, 2 kolom tablet, 3 kolom desktop -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 news-grid">
                    @forelse ($newsList as $news)
                        <x-newspage-card title="{{ $news->name }}"
                            excerpt="{{ \Illuminate\Support\Str::limit(strip_tags($news->content), 140) }}"
                            date="{{ date('d F Y', strtotime($news->publish_date)) }}"
                            category="{{ ucfirst(str_replace('_', ' ', $news->category)) }}"
                            link="{{ route('news.detail', $news->slug) }}"
                            image="{{ $news->image ? asset('storage/' . $news->image) : asset('assets/img/placeholder/dummy.png') }}" />
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10 text-gray-600">
                            Tidak ada berita ditemukan.
                        </div>
                    @endforelse
                </div>

                <x-pagination :paginator="$newsList" />

            </div>
        </div>
    </section>
</x-public.layouts>
