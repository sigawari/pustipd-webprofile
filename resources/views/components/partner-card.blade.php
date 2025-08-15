{{-- resources/views/components/partner-card.blade.php --}}

@props([
    'name' => '',
    'logo' => '',
    'link' => '#',
])

<div class="carousel-slide flex-shrink-0" style="width: calc(100% / 6); min-width: 150px;">
    <div class="mx-3">
        <a href="{{ $link }}" target="_blank" rel="noopener"
            class="partner-card bg-white rounded-lg border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group relative overflow-hidden opacity-100 block"
            style="height: 80px; width: 100%;">
            <!-- Gambar logo -->
            <div class="w-full h-full relative flex items-center justify-center overflow-hidden rounded-lg">
                @if ($logo)
                    <img src="{{ $logo }}" alt="{{ $name }}"
                        class="max-h-[60px] w-auto object-contain mx-auto transition-all duration-300 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <div
                            class="text-gray-600 font-bold text-sm group-hover:scale-110 transition-all duration-300 text-center">
                            {{ substr($name, 0, 8) }}
                        </div>
                    </div>
                @endif

                <!-- Overlay hitam + nama perusahaan di tengah -->
                <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center 
                            opacity-0 group-hover:opacity-100 transition-all duration-300 z-10">
                    <span class="text-white font-bold text-base text-center">{{ $name }}</span>
                </div>
            </div>
        </a>
    </div>
</div>
