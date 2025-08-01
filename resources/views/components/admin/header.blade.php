<!-- Welcome Section -->
<div class="bg-gradient-to-r from-blue-900 to-secondary rounded-xl p-6 m-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, Administrator!</h2>
            <p class="text-blue-100 mb-4">
                Selamat datang di {{ $slot }} admin PUSTIPD
            </p>
            <p class="text-blue-100 mb-4">
                Kelola konten website PUSTIPD UIN Raden Fatah Palembang dengan mudah dan efisien
            </p>
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-2 sm:space-y-0 text-sm text-blue-100">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Login terakhir: {{ now()->format('d M Y, H:i') }} WIB
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    System Online
                </div>
            </div>
        </div>
        <div class="hidden lg:block">
            <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="Logo UIN"
                class="w-20 h-16 opacity-80">
        </div>
    </div>
</div>







<!-- <div class="border-b border-gray-200 px-4 py-4 lg:px-6 lg:py-6">
    <div class="flex items-start justify-between">
         Page Title Section
        <div class="flex-1 min-w-0">
             Breadcrumb
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
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @endif
                </ol>
            </nav>

             Page Title
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

             Page Description
            <p class="text-sm lg:text-base text-gray-600 mt-1 line-clamp-2">
                @yield('page-description', 'Selamat datang di dashboard admin PUSTIPD')
            </p>
        </div>

         Page Actions
        <div class="flex items-center space-x-2 lg:space-x-3 ml-4">
            @hasSection('page-actions')
                <div class="hidden lg:flex items-center space-x-3">
                    @yield('page-actions')
                </div>
            @endif
        </div>
    </div>
</div> -->