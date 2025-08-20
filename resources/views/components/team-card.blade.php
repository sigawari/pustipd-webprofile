<!-- resources/views/components/team-card.blade.php -->
<div class="team-carousel-card flex-shrink-0">
    <div class="bg-white rounded-xl overflow-hidden group cursor-pointer w-56 sm:w-64 md:w-72">

        <!-- Image Container -->
        <div class="relative w-full h-48 sm:h-56 md:h-64 overflow-hidden">
            @php
                $displayName = $nama ?? ($name ?? 'Unknown');
                $photoPath = $foto ?? ($image ?? null);
                $fullImageUrl = null;

                if ($photoPath) {
                    if (filter_var($photoPath, FILTER_VALIDATE_URL)) {
                        $fullImageUrl = $photoPath;
                    } else {
                        $fullImageUrl = asset('storage/' . $photoPath);
                    }
                }
            @endphp

            @if ($fullImageUrl)
                <img src="{{ $fullImageUrl }}" alt="{{ $displayName }}"
                    class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-108"
                    loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                <!-- Fallback -->
                <div class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 flex items-center justify-center opacity-0 transition-opacity duration-300"
                    style="display: none;">
                    <span class="text-4xl sm:text-5xl md:text-6xl font-bold text-white drop-shadow-lg">
                        {{ strtoupper(substr($displayName, 0, 1)) }}
                    </span>
                </div>
            @else
                <!-- Default placeholder -->
                <div
                    class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 flex items-center justify-center">
                    <span class="text-4xl sm:text-5xl md:text-6xl font-bold text-white drop-shadow-lg">
                        {{ strtoupper(substr($displayName, 0, 1)) }}
                    </span>
                </div>
            @endif

            <!-- Overlay yang subtle -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400">
            </div>
        </div>

        <!-- Content section -->
        <div class="p-5 text-center space-y-2">
            <h2
                class="text-lg sm:text-xl font-bold text-gray-800 leading-tight transition-colors duration-300 group-hover:text-blue-600">
                {{ $displayName }}
            </h2>
            <h3 class="text-sm sm:text-base text-gray-600 font-medium transition-colors duration-300">
                {{ $jabatan ?? ($position ?? '') }}
            </h3>
            @if (($email ?? '') !== '')
                <h4
                    class="text-xs sm:text-sm text-gray-500 truncate transition-opacity duration-300 opacity-75 group-hover:opacity-100">
                    {{ $email }}
                </h4>
            @endif
        </div>
    </div>
</div>

<style>
    /* Transisi kartu yang clean tanpa border berlebihan */
    .team-carousel-card>div {
        transition:
            transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275),
            box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: translateZ(0);
        will-change: transform, box-shadow;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Hover state yang clean */
    .team-carousel-card:hover>div {
        transform: translateY(-12px) scale(1.02);
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Scale untuk gambar */
    .scale-108 {
        transform: scale(1.08);
    }

    /* Performance optimizations */
    .team-carousel-card * {
        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
    }

    /* Responsive hover effects */
    @media (hover: hover) {
        .team-carousel-card:hover {
            transform: none;
        }
    }

    @media (hover: none) {
        .team-carousel-card:active>div {
            transform: translateY(-8px) scale(1.01);
            transition: all 0.2s ease-out;
        }
    }

    /* Reduce motion untuk accessibility */
    @media (prefers-reduced-motion: reduce) {

        .team-carousel-card,
        .team-carousel-card * {
            transition-duration: 0.1s !important;
        }
    }
</style>
