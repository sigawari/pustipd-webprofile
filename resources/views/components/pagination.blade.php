@if ($paginator->hasPages())
    {{-- Pagination Navigation --}}
    <div class="mt-8 md:mt-12">
        <div class="flex flex-wrap justify-center items-center gap-3">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-5 py-3 text-gray-400 rounded-md border-2 border-gray-200 bg-gray-50 shadow-sm">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-5 py-3 text-custom-blue bg-white border-2 border-blue-300 rounded-md hover:bg-blue-50 hover:border-custom-blue transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Prev
                </a>
            @endif

            {{-- Page Numbers --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == $paginator->currentPage())
                    <span
                        class="w-12 h-12 flex items-center justify-center bg-custom-blue text-white rounded-md border-3 border-blue-300 shadow-lg font-bold text-lg transform scale-110">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $paginator->url($i) }}"
                        class="w-12 h-12 flex items-center justify-center text-custom-blue bg-white border-2 border-blue-300 rounded-md hover:bg-blue-50 hover:border-custom-blue transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 hover:scale-105 font-semibold">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-5 py-3 text-custom-blue bg-white border-2 border-blue-300 rounded-md hover:bg-blue-50 hover:border-custom-blue transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Next
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="px-5 py-3 text-gray-400 rounded-md border-2 border-gray-200 bg-gray-50 shadow-sm">
                    Next
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif

        </div>
    </div>
@endif

<style>
    /* Custom Blue Colors */
    .border-3 {
        border-width: 3px;
    }

    /* Pagination Link Styles */
    .pagination-wrapper a,
    div a[href*="page="] {
        display: inline-flex !important;
        text-decoration: none !important;
        cursor: pointer !important;
        align-items: center;
        justify-content: center;
    }

    /* Hover Animations */
    div a[href*="page="]:hover {
        animation: bounce 0.6s ease-in-out;
    }

    @keyframes bounce {

        0%,
        20%,
        60%,
        100% {
            transform: translateY(0) scale(1);
        }

        40% {
            transform: translateY(-8px) scale(1.05);
        }

        80% {
            transform: translateY(-4px) scale(1.02);
        }
    }

    /* Pulse animation for current page */
    .bg-gradient-to-br {
        animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    @keyframes pulse-glow {
        from {
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5), 0 0 20px rgba(59, 130, 246, 0.3);
        }

        to {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.6);
        }
    }
</style>
