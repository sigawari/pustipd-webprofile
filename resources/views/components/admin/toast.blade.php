@php
    $type = session('success') ? 'success' : (session('error') ? 'error' : null);
    $msg = session('success') ?? session('error');
@endphp

@if ($type && $msg)
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition role="alert" {{-- sm: → desktop / default --}}
        {{-- !sm: → mobile (<640px) --}}
        class="fixed
             top-2 left-1/2 -translate-x-1/2        {{-- mobile: tengah-atas --}}
             sm:top-4 sm:left-auto sm:right-4 sm:translate-x-0   {{-- desktop: kanan-atas --}}
             z-[9999] w-[90vw] sm:w-full sm:max-w-sm
             bg-white shadow-lg rounded-lg pointer-events-auto select-none">

        <div class="p-4 flex items-start">
            {{-- ikon --}}
            <div class="flex-shrink-0 mt-0.5">
                @if ($type === 'success')
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @else
                    <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
            </div>

            {{-- pesan --}}
            <p class="ml-3 flex-1 text-sm font-medium text-gray-900">
                {{ $msg }}
            </p>

            {{-- tombol tutup --}}
            <button @click="show=false" class="ml-4 text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- progress-bar yang diperbaiki --}}
        <div class="h-1 w-full overflow-hidden bg-gray-200 rounded-b-lg">
            <div class="h-full {{ $type === 'success' ? 'bg-green-400' : 'bg-red-400' }}" x-init="setTimeout(() => $el.style.width = '0%', 100)"
                style="width:100%; transition:width 4s linear">
            </div>
        </div>
    </div>
@endif
