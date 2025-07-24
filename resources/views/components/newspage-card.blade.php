<a href="{{ $link }}"
    class="block newspage-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-500 transform hover:-translate-y-2 group">
    <!-- News Image -->
    @if ($image)
        <div class="relative h-50 overflow-hidden">
            <img src="{{ $image }}" alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute top-4 left-4">
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                    {{ $category }}
                </span>
            </div>
        </div>
    @endif

    <!-- Card Content -->
    <div class="p-4">
        <div class="flex items-center justify-between mb-3">
            @if (!$image)
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                    {{ $category }}
                </span>
            @endif
            <span class="text-sm text-gray-500">{{ $date }}</span>
        </div>

        <!-- Title -->
        <h3
            class="text-lg font-bold text-gray-800 mb-3 group-hover:text-custom-blue transition-colors duration-300 line-clamp-2">
            {{ $title }}
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
            {{ $excerpt }}
        </p>
    </div>
</a>
