<div class="bg-white border-b border-gray-200 px-4 py-4 lg:px-6 lg:py-6 ml-0 lg:ml-[290px] transition-all duration-300"
    :class="sidebarToggle ? 'lg:ml-[90px]' : 'lg:ml-[290px]'">
    <div class="flex items-start justify-between">
        <!-- Page Title Section -->
        <div class="flex-1 min-w-0">
            <!-- Breadcrumb -->
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
                            Dashboard
                        </a>
                    </li>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @endif
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="flex items-center">
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900 truncate">
                    @yield('page-title', 'Dashboard')
                </h1>
                @hasSection('page-badge')
                    <div class="ml-3">
                        @yield('page-badge')
                    </div>
                @endif
            </div>

            <!-- Page Description -->
            <p class="text-sm lg:text-base text-gray-600 mt-1 line-clamp-2">
                @yield('page-description', 'Selamat datang di dashboard admin PUSTIPD')
            </p>

            <!-- Page Meta Info (Optional) -->
            @hasSection('page-meta')
                <div class="flex items-center mt-2 text-xs text-gray-500 space-x-4">
                    @yield('page-meta')
                </div>
            @endif
        </div>

        <!-- Page Actions -->
        <div class="flex items-center space-x-2 lg:space-x-3 ml-4">
            <!-- Mobile Actions Dropdown -->
            <div class="relative lg:hidden" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen"
                    class="flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                        </path>
                    </svg>
                </button>

                <!-- Mobile Actions Dropdown Menu -->
                <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 py-1">
                    @yield('mobile-actions')
                </div>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden lg:flex items-center space-x-3">
                @yield('page-actions')
            </div>
        </div>
    </div>

    <!-- Page Stats/Quick Info Cards -->
    @hasSection('page-stats')
        <div class="mt-4 lg:mt-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
                @yield('page-stats')
            </div>
        </div>
    @endif

    <!-- Page Tabs/Navigation (Optional) -->
    @hasSection('page-tabs')
        <div class="mt-4 lg:mt-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 overflow-x-auto">
                @yield('page-tabs')
            </nav>
        </div>
    @endif

    <!-- Page Filters/Search (Optional) -->
    @hasSection('page-filters')
        <div class="mt-4 lg:mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
            @yield('page-filters')
        </div>
    @endif
</div>
