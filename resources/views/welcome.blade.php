<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PUSTIPD</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                :root {
                    --color-background: #001f3f;
                    /* Dark blue background */
                    --color-text: #ffffff;
                    /* White text */
                    --color-border: #003366;
                    /* Darker blue for borders */
                }

                body {
                    background-color: var(--color-background);
                    color: var(--color-text);
                }

                a {
                    color: var(--color-text);
                }

                .border {
                    border-color: var(--color-border);
                }

                /* .bg-white {
                    background-color: var(--color-background) !important;
                } */

                .text-white {
                    color: var(--color-text) !important;
                }
            </style>
        @endif
    </head>

    <body class="flex flex-col min-h-screen bg-blue-950">
        {{-- isi halaman --}}
        <main class="flex-grow">
            @include('components.public.uppernav')
            @include('components.public.navbartransparent')
            @include('components.public.navbar-light')
            @include('components.public.navbar-dark')
        </main>

        {{-- Footer --}}
        @include('components.public.footer')
    </body>

</html>
