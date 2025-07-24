<div class="carousel-slide flex-shrink-0" style="width: calc(100% / 6); min-width: 150px;">
    <div class="mx-3">
        <div class="partner-card bg-white rounded-lg border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group relative overflow-hidden opacity-100"
            style="height: 80px; width: 100%;">

            <!-- Image Container dengan Full Coverage -->
            <div class="w-full h-full relative overflow-hidden rounded-lg">
                @if ($logo)
                    <div class="w-full h-full relative">
                        <img src="{{ asset($logo) }}" alt="{{ $name }}"
                            class="w-full h-full object-contain p-2 group-hover:scale-105 transition-all duration-300 filter-none">

                        <!-- Optional: Overlay untuk branding protection -->
                        <div
                            class="absolute inset-0 bg-white/5 group-hover:bg-white/10 transition-all duration-300 pointer-events-none">
                        </div>
                    </div>
                @else
                    <!-- Fallback dengan nama singkat -->
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <div
                            class="text-gray-600 font-bold text-sm group-hover:scale-110 transition-all duration-300 text-center">
                            {{ substr($name, 0, 8) }}
                        </div>
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
</div>
