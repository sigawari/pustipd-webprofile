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

            <!-- Grid Card Tutorial: Tampilan Lebih Menarik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                @forelse ($tutorialsList as $tutorial)
                    <a href="{{ route('tutorials-detail', $tutorial->slug) }}"
                        class="group relative flex flex-col p-6 rounded-3xl shadow-lg hover:scale-105 hover:border-custom-blue transition-all duration-500 bg-white transform hover:-translate-y-2 overflow-hidden"
                        title="{{ $tutorial->title }}">

                        <!-- Content wrapper -->
                        <div class="relative z-10 flex flex-col h-full">
                            <!-- Bagian Dilihat -->
                            <div
                                class="flex items-center text-sm text-white bg-custom-blue justify-center rounded-full px-3 py-1.5 mb-4 gap-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm8 0c0 5-7 9-10 9S2 17 2 12 9 3 12 3s10 4 10 9z" />
                                </svg>
                                <span class="font-medium">
                                    {{ $tutorial->view_count ?? 0 }} x dilihat
                                </span>
                            </div>

                            <!-- Title -->
                            <div
                                class="font-bold text-lg md:text-xl text-secondary text-center mb-3 group-hover:text-custom-blue transition-colors duration-300 leading-tight">
                                {{ $tutorial->title }}
                            </div>

                            <!-- Content/Excerpt -->
                            @if ($tutorial->excerpt)
                                <div
                                    class="text-gray-600 text-center text-sm mb-4 flex-grow flex items-center justify-center leading-relaxed">
                                    {{ Str::limit($tutorial->excerpt, 60) }}
                                </div>
                            @elseif ($tutorial->content_blocks && count($tutorial->content_blocks) > 0)
                                @php
                                    $firstBlock = collect($tutorial->content_blocks)->first();
                                    $previewContent = $firstBlock['title'] ?? strip_tags($firstBlock['content'] ?? '');
                                @endphp
                                <div
                                    class="text-gray-600 text-center text-sm mb-4 flex-grow flex items-center justify-center leading-relaxed">
                                    {{ Str::limit($previewContent, 60) }}
                                </div>
                            @endif

                            <!-- Bottom accent line -->
                            <div
                                class="w-full h-1 bg-gradient-to-r from-custom-blue to-secondary rounded-full mt-auto opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-x-0 group-hover:scale-x-100">
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-5 text-center py-16 text-gray-600">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium">Tidak ada tutorial ditemukan</p>
                        <p class="text-sm text-gray-500 mt-1">Silakan coba lagi nanti atau periksa filter pencarian</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <x-pagination :paginator="$tutorialsList" />
        </div>
    </section>
</x-public.layouts>
