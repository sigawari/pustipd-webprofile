<x-public.layouts :title="$title" :description="$description" :keywords="$keywords">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="tutorial" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Header Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary m-6 relative inline-block underline-animate">
                    Tutorial
                </h2>
                <h3 class="text-lg text-secondary max-w-2xl mx-auto pt-2">
                    Beberapa tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden
                    Fatah Palembang
                </h3>
            </div>
            <!-- Search Form -->
            <form action="{{ route('tutorials') }}" method="GET" class="relative w-full max-w-md mx-auto mb-8">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari Tutorial di sini...."
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

            <!-- Grid Card Tutorial -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($tutorialsList as $tutorial)
                    <a href="{{ route('tutorials-detail', $tutorial->slug) }}"
                        class="p-4 rounded-xl shadow-md bg-white hover:shadow-lg transition"
                        title="{{ $tutorial->title }}">
                        <div class="font-bold text-lg text-secondary">{{ $tutorial->title }}</div>
                        @if ($tutorial->excerpt)
                            <div class="text-gray-600 text-sm">
                                {{ \Illuminate\Support\Str::limit($tutorial->excerpt, 80) }}
                            </div>
                        @elseif ($tutorial->content_blocks && count($tutorial->content_blocks) > 0)
                            @php
                                $firstBlock = collect($tutorial->content_blocks)->first();
                                $previewContent = $firstBlock['title'] ?? strip_tags($firstBlock['content'] ?? '');
                            @endphp
                            <div class="text-gray-600 text-sm">
                                {{ \Illuminate\Support\Str::limit($previewContent, 80) }}
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-600">
                        Tidak ada tutorial ditemukan.
                    </div>
                @endforelse
            </div>


            <!-- Pagination -->
            <x-pagination :paginator="$tutorialsList" />
        </div>
    </section>
</x-public.layouts>
