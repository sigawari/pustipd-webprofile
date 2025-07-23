<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>PUSTIPD | {{ $title }}</title>
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/logo/logo-uin-rfp.png') }}" type="image/x-icon">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">

    <!-- Font -->

    <!-- CSS -->


    <!-- JS -->


</head>
<body>
    <div class="flex flex-col min-h-screen bg-blue-950">
        {{-- Isi Halaman --}}
        <!-- Navbar -->
        <x-public.navbar></x-public.navbar>
        <!-- Main -->
         <main class="flex-grow">
            <x-public.header>{{$title}}</x-public.header>
            {{$slot}}
        </main>
        <!-- Footer -->
        <x-public.footer></x-public.footer>
    </div>
    
    <script>
        // ===============================
        // Script Navbar Color Change on Scroll
        // ===============================
        const navbar = document.getElementById('navbar');
        const navbarTitle = document.getElementById('navbar-title');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
            // Check if dark mode is active
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-gray-900');
                navbarTitle.classList.remove('text-white');
                navbarTitle.classList.add('text-white');
            } else {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white');
                navbarTitle.classList.remove('text-white');
                navbarTitle.classList.add('text-[#062749]');
            }
            } else {
            navbar.classList.remove('bg-white', 'bg-gray-900');
            navbar.classList.add('bg-transparent');
            navbarTitle.classList.remove('text-[#062749]');
            navbarTitle.classList.add('text-white');
            }
        });
        </script>

</body>
</html>