@props(['urgency', 'category', 'title', 'excerpt', 'date', 'link'])

<div
    class="announcement-card bg-white rounded-lg shadow-sm border-l-4 
    {{ $urgency === 'penting' ? 'border-red-500' : 'border-blue-400' }}
    overflow-hidden hover:shadow-xl 
    {{ $urgency === 'penting' ? 'hover:border-l-red-600' : 'hover:border-l-blue-500' }}
    transition-all duration-500 transform hover:-translate-y-2 group">

    <!-- Card Header dengan Icon -->
    <div class="p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-3">
                <!-- Icon Pengumuman -->
                <div
                    class="w-10 h-10 min-h-[40px] max-h-[40px] rounded-lg flex items-center justify-center transition-colors duration-300
                    {{ $urgency === 'penting' ? 'bg-red-100 group-hover:bg-red-200' : 'bg-blue-100 group-hover:bg-blue-200' }}">
                    @if ($urgency === 'penting')
                        <!-- Icon Warning untuk Penting -->
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @else
                        <!-- Icon Megaphone untuk Normal -->
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    @endif
                </div>
                <div>
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        {{ $urgency === 'penting' ? 'bg-red-500 text-white' : 'bg-blue-100 text-blue-800' }}">
                        {{ $category }}
                    </span>
                    @if ($urgency === 'penting')
                        <span
                            class="inline-block ml-2 px-2 py-1 text-xs font-bold rounded-full bg-yellow-200 text-red-800 animate-pulse">
                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            PENTING
                        </span>
                    @endif
                </div>
            </div>
            <span class="text-sm text-gray-500">{{ $date }}</span>
        </div>

        <!-- Title -->
        <h3
            class="text-lg font-bold text-gray-800 mb-3 transition-colors duration-300 line-clamp-2
            {{ $urgency === 'penting' ? 'group-hover:text-red-600' : 'group-hover:text-blue-600' }}">
            {{ $title }}
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
            {{ $excerpt }}
        </p>

        <!-- Action Button dengan desain dinamis -->
        <a href="{{ $link }}"
            class="inline-flex items-center justify-center w-full px-4 py-2 text-white font-semibold text-sm rounded-lg transition-all duration-300 transform group-hover:scale-105 hover:shadow-md
            {{ $urgency === 'penting' ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }}">
            Lihat Pengumuman
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
