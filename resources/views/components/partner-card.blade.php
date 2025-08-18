@props([
    'name' => '',
    'logo' => '',
])

<div class="max-w-[200px] mx-auto">
    <div
        class="partner-card bg-white rounded-lg border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group relative overflow-hidden block h-[120px]">
        <div class="w-full h-full relative flex items-center justify-center overflow-hidden rounded-lg">
            @if ($logo && $logo !== asset('assets/img/placeholder/dummy.png'))
                <img src="{{ $logo }}" alt="{{ $name }}"
                    class="max-h-[110px] w-auto object-contain mx-auto transition-all duration-300 group-hover:scale-105" />
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <div
                        class="text-gray-600 font-bold text-sm group-hover:scale-110 transition-all duration-300 text-center">
                        {{ substr($name, 0, 8) }}
                    </div>
                </div>
            @endif

            <!-- Overlay nama perusahaan di tengah -->
            <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10">
                <span class="text-white font-bold text-base text-center px-2">{{ $name }}</span>
            </div>
        </div>
    </div>
</div>
