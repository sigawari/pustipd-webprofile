<div class="carousel-slide min-w-full md:min-w-1/2 lg:min-w-1/4 xl:min-w-1/6 px-3">
    <div class="partner-card bg-white rounded-lg border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group relative overflow-hidden"
        style="height: 80px; min-height: 80px; max-height: 80px;">

        <!-- Image Container dengan Fixed Dimensions -->
        <div class="w-full h-full flex items-center justify-center p-3 relative overflow-hidden">
            @if ($logo)
                <div class="w-full h-full flex items-center justify-center">
                    <img src="{{ asset($logo) }}" alt="{{ $name }}"
                        class="max-w-full max-h-full object-contain group-hover:scale-105 transition-all duration-300 filter-none">
                </div>
            @else
                <!-- Fallback dengan nama singkat -->
                <div
                    class="text-gray-600 font-bold text-sm group-hover:scale-110 transition-all duration-300 text-center">
                    {{ substr($name, 0, 8) }}
                </div>
            @endif
        </div>

        <!-- Tooltip yang diperbaiki -->
        <div
            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-3 px-3 py-2 bg-gray-900/95 backdrop-blur-sm text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap z-30 pointer-events-none shadow-lg">
            {{ $name }}
            <!-- Arrow tooltip -->
            <div
                class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900/95">
            </div>
        </div>
    </div>
</div>
