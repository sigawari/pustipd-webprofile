@props(['title'])

<div x-data="{ open: false }" class="border border-gray-200 rounded-lg">
    <button @click="open = !open"
        class="w-full px-4 py-3 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-secondary">
        <span class="font-semibold text-gray-900">{{ $title }}</span>
        <svg :class="{ 'transform rotate-180': open }" class="w-5 h-5 text-secondary transition-transform duration-200"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" x-collapse class="px-4 py-3 text-gray-700 border-t border-gray-200">
        {{ $slot }}
    </div>
</div>
