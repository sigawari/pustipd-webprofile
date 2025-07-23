<!-- resources/views/components/team-card.blade.php -->
<div class="team-carousel-card flex-shrink-0 mx-4">
    <div
        class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-2 group w-72">
        <!-- Image Container -->
        <div class="relative w-full h-64 overflow-hidden">
            @if ($image)
                <img src="{{ $image }}" alt="{{ $name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <!-- Placeholder dengan inisial -->
                <div class="w-full h-full bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                    <span class="text-6xl font-bold text-white">{{ $initials }}</span>
                </div>
            @endif

            <!-- Overlay effect saat hover -->
            <div
                class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
        </div>

        <!-- Content Container -->
        <div class="p-6 text-center h-40 flex flex-col justify-center">
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">
                {{ $name }}</h3>
            <p class="text-secondary font-medium mb-3">{{ $position }}</p>
        </div>
    </div>
</div>
