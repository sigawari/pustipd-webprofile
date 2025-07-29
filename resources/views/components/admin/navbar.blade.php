<div x-data="{
    darkMode: false,
    isNotificationsMenuOpen: false,
    isProfileMenuOpen: false
}"
    class="sticky top-0 z-40 w-full bg-white border-b border-gray-200 shadow-sm transition-all duration-300">
    <div class="flex items-center justify-between px-4 py-3 lg:px-6">
        <!-- Mobile Menu Button & Logo Area -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Sidebar Toggle (visible on mobile only) -->
            <button @click="sidebarToggle = !sidebarToggle"
                class="flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 lg:hidden transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <!-- Desktop Sidebar Toggle (visible on desktop) -->
            <button @click="sidebarToggle = !sidebarToggle"
                class="hidden lg:flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <!-- Logo dan Title (responsive) -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="logo"
                    class="w-8 h-7 lg:w-12 lg:h-10">
                <div class="leading-tight text-xs lg:text-base">
                    <div class="font-semibold text-gray-900">PUSTIPD</div>
                    <div class="text-gray-600 hidden sm:block">UIN RADEN FATAH Palembang</div>
                </div>
            </div>
        </div>

        <!-- Search Bar (desktop only) -->
        <div class="hidden md:flex flex-1 max-w-lg mx-8">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50"
                    placeholder="Cari menu, halaman, atau data...">
            </div>
        </div>

        <!-- Icon Area -->
        <div class="relative flex items-center space-x-2 lg:space-x-4">
            <!-- Mobile Search Button -->
            <button
                class="flex md:hidden items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>

            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode"
                class="flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                <!-- Light Mode Icon -->
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <!-- Dark Mode Icon -->
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <!-- Notification Icon -->
            <div class="relative">
                <button @click="isNotificationsMenuOpen = !isNotificationsMenuOpen; isProfileMenuOpen = false"
                    class="relative flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <!-- Notification Badge -->
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                </button>

                <!-- Dropdown Notification -->
                <div x-show="isNotificationsMenuOpen" @click.away="isNotificationsMenuOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">

                    <!-- Header -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                            <span class="text-xs text-gray-500">3 baru</span>
                        </div>
                    </div>

                    <!-- Notification Items -->
                    <div class="max-h-64 overflow-y-auto">
                        <div class="p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Data baru ditambahkan</p>
                                    <p class="text-xs text-gray-500">2 menit yang lalu</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 text-center">
                            <p class="text-sm text-gray-500">Belum ada notifikasi lainnya</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                        <button class="text-xs text-blue-600 hover:text-blue-700 font-medium">
                            Lihat semua notifikasi
                        </button>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="relative">
                <button @click="isProfileMenuOpen = !isProfileMenuOpen; isNotificationsMenuOpen = false"
                    class="flex items-center space-x-2 p-1 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="User"
                        class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-2 border-gray-200">
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-medium text-gray-900">Administrator</p>
                        <p class="text-xs text-gray-500">Super Admin</p>
                    </div>
                    <svg class="hidden lg:block w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <!-- Dropdown Profile -->
                <div x-show="isProfileMenuOpen" @click.away="isProfileMenuOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">

                    <!-- Profile Header -->
                    <div class="px-4 py-4 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="User"
                                class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                            <div>
                                <p class="font-semibold text-gray-900">Administrator</p>
                                <p class="text-sm text-gray-500">admin@pustipd.uin-suka.ac.id</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Bantuan
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="border-t border-gray-100">
                        <a href="#"
                            class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
