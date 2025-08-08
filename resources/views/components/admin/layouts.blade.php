<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUSTIPD | {{ $title }}</title>

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('description', 'Sistem Manajemen Konten PUSTIPD UIN Raden Fatah Palembang')">
        <meta name="keywords" content="@yield('keywords', 'PUSTIPD, UIN Raden Fatah, CMS, Admin')">

        <!-- Script -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- CSS -->

    </head>

    <body class="bg-gray-50">
        <div x-data="{
            sidebarToggle: localStorage.getItem('sidebarToggle') === 'true' || false,
            darkMode: localStorage.getItem('darkMode') === 'true' || false
        }"
            @toggle-sidebar.window="sidebarToggle = !sidebarToggle; localStorage.setItem('sidebarToggle', sidebarToggle)"
            x-init="$watch('sidebarToggle', value => {
                localStorage.setItem('sidebarToggle', value);
                console.log('Sidebar state:', value ? 'COLLAPSED (Mini)' : 'EXPANDED (Full)');
            });
            $watch('darkMode', value => localStorage.setItem('darkMode', value));
            console.log('Initial sidebar state:', sidebarToggle ? 'COLLAPSED' : 'EXPANDED');" class="flex flex-col min-h-screen">

            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Sidebar -->
            <x-admin.sidebar />

            <!-- Main Content Area - PERBAIKAN DI SINI -->
            <div class="transition-all duration-300 ease-in-out"
                :class="{
                    'ml-0 lg:ml-[90px]': sidebarToggle, // Sidebar COLLAPSED (mini) - margin kecil
                    'ml-0 lg:ml-[290px]': !sidebarToggle // Sidebar EXPANDED (full) - margin besar
                }">

                <!-- Header -->
                @if (Route::currentRouteName() === 'admin.dashboard.index')
                    {{-- Tampilkan welcome header hanya di dashboard --}}
                    @include('components.admin.header-welcome')
                @else
                    {{-- Tampilkan header biasa di halaman lain --}}
                    @include('components.admin.header-default', [
                        'pageData' => [
                            'pageName' => $title ?? 'Halaman',
                            'title' => $title ?? 'Judul Halaman',
                            'description' => 'Kelola konten sesuai kebutuhan Anda.',
                        ],
                    ])
                @endif

                <!-- Page Content -->
                <main class="min-h-screen mb">
                    {{ $slot }}
                </main>

                <x-admin.toast />
                <x-admin.footer />
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarToggle && window.innerWidth < 1024" @click="sidebarToggle = false"
                class="fixed inset-0 z-25 lg:hidden" style="background-color: rgba(0, 0, 0, 0.15);"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            </div>
        </div>
    </body>

</html>
