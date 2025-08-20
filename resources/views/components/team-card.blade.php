<!-- resources/views/components/team-card.blade.php -->
<div class="team-carousel-card flex-shrink-0">
    <div
        class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-2 group w-56 sm:w-64 md:w-72">
        <!-- Image Container -->
        <div class="relative w-full h-48 sm:h-56 md:h-70 overflow-hidden">
            @if ($image)
                <img src="{{ $image }}" alt="{{ $name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <!-- Placeholder dengan inisial -->
                <div class="w-full h-full bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                    <span class="text-4xl sm:text-5xl md:text-6xl font-bold text-white">{{ $initials }}</span>
                </div>
            @endif

            <!-- Overlay effect saat hover -->
            <div
                class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
        </div>

        <!-- Content Container -->
        <div class="p-2 text-center h-20 sm:h-24 md:h-30 flex flex-col justify-center">
            <h2
                class="text-lg sm:text-xl font-bold text-secondary mb-1 group-hover:text-custom-blue transition-colors duration-300">
                {{ $name }}</h2>
            <h3 class="text-sm sm:text-base text-secondary font-medium mb-2 sm:mb-3">{{ $position }}</h3>
            <h4 class="text-sm sm:text-base text-secondary font-medium mb-2 sm:mb-3">{{ $email }}</h4>
        </div>
    </div>
</div>
