<a href="{{ $link }}"
    class="block newspage-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-1 group h-full flex flex-col">

    <!-- News Image -->
    @if ($image)
        <div class="relative h-48 overflow-hidden flex-shrink-0">
            <img src="{{ $image }}" alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute top-3 left-3">
                <span
                    class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-white/90 backdrop-blur-sm text-secondary shadow-sm">
                    {{ $category }}
                </span>
            </div>
        </div>
    @endif

    <!-- Card Content -->
    <div class="p-4 flex flex-col flex-grow">
        <!-- Category and Date (when no image) -->
        @if (!$image)
            <div class="flex items-center justify-between mb-3">
                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-secondary">
                    {{ $category }}
                </span>
                <span class="text-xs text-gray-500">{{ $date }}</span>
            </div>
        @else
            <div class="flex justify-end mb-3">
                <span class="text-xs text-gray-500">{{ $date }}</span>
            </div>
        @endif

        <!-- Title -->
        <h3
            class="text-base font-bold text-gray-800 mb-2 group-hover:text-custom-blue transition-colors duration-300 line-clamp-2 leading-tight">
            {{ $title }}
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
            {{ $excerpt }}
        </p>

        <!-- Action Button -->
        <div class="mt-auto">
            <button
                class="inline-flex items-center justify-center w-full px-3 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-medium text-sm rounded-lg transition-all duration-300 transform group-hover:scale-[1.02] hover:shadow-md">
                Baca Selengkapnya
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</a>
