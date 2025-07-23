<div
    class="announcement-card bg-white rounded-lg shadow-sm border-l-4 {{ $priority === 'urgent' ? 'border-red-500' : 'border-red-400' }} overflow-hidden hover:shadow-xl hover:border-l-red-600 transition-all duration-500 transform hover:-translate-y-2 group">
    <!-- Card Header dengan Icon -->
    <div class="p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-3">
                <!-- Icon Pengumuman -->
                <div
                    class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors duration-300">
                    @if ($priority === 'urgent')
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    @endif
                </div>
                <div>
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $priority === 'urgent' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-600' }}">
                        {{ $category }}
                    </span>
                    @if ($priority === 'urgent')
                        <span
                            class="inline-block ml-2 px-2 py-1 text-xs font-bold rounded-full bg-yellow-400 text-gray-900 animate-pulse">
                            URGENT
                        </span>
                    @endif
                </div>
            </div>
            <span class="text-sm text-gray-500">{{ $date }}</span>
        </div>

        <!-- Title -->
        <h3
            class="text-lg font-bold text-gray-800 mb-3 group-hover:text-red-600 transition-colors duration-300 line-clamp-2">
            {{ $title }}
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
            {{ $excerpt }}
        </p>

        <!-- Action Button dengan desain merah -->
        <a href="{{ $link }}"
            class="inline-flex items-center justify-center w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold text-sm rounded-lg transition-all duration-300 transform group-hover:scale-105 hover:shadow-md">
            Lihat Pengumuman
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
