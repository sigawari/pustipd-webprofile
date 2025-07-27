<div 
    x-data="{ 
        darkMode: false, 
        isNotificationsMenuOpen: false, 
        isProfileMenuOpen: false 
    }" 
    class="sticky top-0 z-50 w-full bg-gray-900 text-white border-b border-gray-800"
>
    <div class="flex items-center justify-between px-4 py-3 lg:px-6">
        <!-- Logo dan Title -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo-uin-rfp-white.png') }}" alt="logo" class="w-12 h-10">
            <div class="leading-tight text-sm lg:text-base">
                <div class="font-semibold">PUSTIPD</div>
                <div>UIN RADEN FATAH Palembang</div>
            </div>
        </div>

        <!-- Icon Area -->
        <div class="relative flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode"
                class="flex items-center justify-center w-10 h-10 rounded-full text-gray-300 hover:bg-gray-700">
                <!-- Icon swap -->
                <svg x-show="!darkMode" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>
                <svg x-show="darkMode" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
            </button>

            <!-- Notification Icon -->
            <div class="relative">
                <button @click="isNotificationsMenuOpen = !isNotificationsMenuOpen; isProfileMenuOpen = false"
                    class="flex items-center justify-center w-10 h-10 rounded-full text-gray-300 hover:bg-gray-700">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>

                <!-- Dropdown Notification -->
                <div x-show="isNotificationsMenuOpen" @click.away="isNotificationsMenuOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-64 bg-white text-gray-900 rounded-md shadow-md z-50 p-4">
                    <p class="text-sm text-gray-600">Belum ada notifikasi hari ini</p>
                </div>
            </div>

            <!-- User Profile -->
            <div class="relative">
                <button @click="isProfileMenuOpen = !isProfileMenuOpen; isNotificationsMenuOpen = false"
                    class="block w-10 h-10 overflow-hidden rounded-full border border-gray-700">
                    <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="User"
                        class="w-full h-full object-cover">
                </button>

                <!-- Dropdown Profile -->
                <div x-show="isProfileMenuOpen" @click.away="isProfileMenuOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-64 bg-white text-gray-900 rounded-md shadow-md z-50 p-4 space-y-3">

                    <!-- Greeting -->
                    <div class="flex items-center space-x-3">
                        <!-- Heroicon: User -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 100 8 4 4 0 000-8zM3 14a7 7 0 0114 0v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="font-semibold">Hallo, Administrator!</p>
                    </div>

                    <!-- Info -->
                    <div class="flex items-center space-x-3">
                        <!-- Heroicon: Database -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M4 3c0-.828.895-1.5 2-1.5h8c1.105 0 2 .672 2 1.5v1c0 .828-.895 1.5-2 1.5H6C4.895 5.5 4 4.828 4 4V3zm12 4H4v2h12V7zm0 3H4v2h12v-2zm0 3H4v1c0 .828.895 1.5 2 1.5h8c1.105 0 2-.672 2-1.5v-1z" />
                        </svg>
                        <p class="text-sm text-gray-600">Pantau pangkalan data hari ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
