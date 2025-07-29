<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUSTIPD | Admin</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

        <!-- SEO Meta Tags -->
        <meta name="description" content="deskripsi halaman ini">
        <meta name="keywords" content="keywords, for, this, page">

        <!-- Font -->

        <!-- CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->

        <!-- JS -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    </head>

    <body>
        <div class="flex flex-col min-h-screen">
            {{-- Isi Halaman --}}
            <x-admin.navbar></x-admin.navbar>
            <!-- Navbar -->
            <!-- Main -->
            <main class="flex-grow">
                <x-admin.header></x-admin.header>
                {{ $slot }}
                <x-admin.sidebar></x-admin.sidebar>
            </main>
            <!-- Footer -->
            <x-admin.footer></x-admin.footer>
        </div>

        <!-- =============================== -->
        <!-- Script Section -->
        <!-- =============================== -->


    </body>

</html>
