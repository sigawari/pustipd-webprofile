<div class="bg-white border-b border-gray-200 px-6 py-6">
    <div class="flex items-center justify-between">
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            <p class="text-gray-600 mt-1">@yield('page-description', 'Selamat datang di dashboard admin PUSTIPD')</p>
        </div>

        <!-- Page Actions -->
        <div class="flex items-center space-x-3">
            @yield('page-actions')
        </div>
    </div>

    <!-- Page Stats (Optional) -->
    @hasSection('page-stats')
        <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            @yield('page-stats')
        </div>
    @endif
</div>
