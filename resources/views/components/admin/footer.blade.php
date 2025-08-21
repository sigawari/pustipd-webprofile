<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="px-4 py-4 lg:px-6">
        <!-- Main Footer Content -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-4">
            <!-- Copyright -->
            <div class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                        clip-rule="evenodd" />
                </svg>
                <span>© 2025 <strong>PUSTIPD UIN Raden Fatah Palembang</strong>. All rights reserved.</span>
            </div>

            <!-- Made with Love & Links -->
            <div class="flex items-center space-x-4 text-sm">
                <!-- Made with love -->
                <div class="flex items-center text-gray-600">
                    <span>Made with</span>
                    <svg class="w-4 h-4 mx-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>by <strong class="text-gray-900">Tim IT PUSTIPD</strong></span>
                </div>

                <!-- Separator -->
                <div class="hidden sm:block w-px h-4 bg-gray-300"></div>

                <!-- Version/Status -->
                <div class="flex items-center space-x-2">
                    <span
                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>
                        Online
                    </span>
                    <span class="text-xs text-gray-500">v2.1.0</span>
                </div>
            </div>
        </div>

        <!-- Additional Footer Info (Optional) -->
        <div class="mt-3 pt-3 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500">
                <!-- Last Updated -->
                <div class="flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Last updated: <span id="last-updated">{{ date('d M Y, H:i') }} WIB</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status Indicator (Optional) -->
    <div class="bg-gray-50 border-t border-gray-200 px-4 py-2 lg:px-6">
        <div class="flex items-center justify-center text-xs text-gray-500">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    <span>Database: Connected</span>
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    <span>Server: Operational</span>
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></span>
                    <span>Maintenance: Scheduled 02:00 WIB</span>
                </div>
            </div>
        </div>
    </div>
</footer>
