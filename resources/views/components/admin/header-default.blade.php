{{-- components/header-default.blade.php --}}
<div class="border-b border-gray-200 px-4 py-4 lg:px-6 lg:py-6">
    <div class="flex items-start justify-between">
        <div class="flex-1 min-w-0">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            {{ $pageData['pageName'] ?? 'Dashboard' }}
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="flex items-center">
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900 truncate">
                    {{ $pageData['title'] ?? 'Judul Halaman' }}
                </h1>
            </div>

            <p class="text-sm lg:text-base text-gray-600 mt-1 line-clamp-2">
                {{ $pageData['description'] ?? 'Deskripsi singkat halaman' }}
            </p>
        </div>

        {{-- Page actions opsional --}}
        @if (!empty($pageData['actions']))
            <div class="flex items-center space-x-2 lg:space-x-3 ml-4">
                {!! $pageData['actions'] !!}
            </div>
        @endif
    </div>
</div>
