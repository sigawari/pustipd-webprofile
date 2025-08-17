<x-public.layouts :title="$title" :description="$description" :keywords="$keywords">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="berita-detail" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">

            <!-- Heading Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Berita
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Berita terbaru dari PUSTIPD
                </h3>
            </div>

            <div class="news-full-article-container mx-auto">
                <h1 class="news-title-detail" id="judul-berita">
                    {{ $news->name }}
                </h1>

                <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('assets/img/placeholder/dummy.png') }}"
                    alt="{{ $news->name }}" class="news-img-detail" />

                <div class="news-date-cat mb-2 text-center">
                    {{ ucfirst(str_replace('_', ' ', $news->category)) }} &middot;
                    <span>{{ $news->publish_date ? \Carbon\Carbon::parse($news->publish_date)->format('d F Y') : '-' }}</span>
                </div>

                <x-share-buttons :url="$url" :share-text="$shareText" />

                <div>
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </section>

</x-public.layouts>
