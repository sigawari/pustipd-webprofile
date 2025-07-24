<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .underline-animate::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 0;
            height: 4px;
            width: 0;
            background-color: #062749;
            transition: width 0.4s ease;
        }

        .group:hover .underline-animate::after {
            width: 100%;
        }
    </style>

    <section id="visi-misi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Tutorial
                </h2>
                <p class="text-center text-secondary mb-8 pt-3 max-w-x">
                    Beberapa tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden
                    Fatah Palembang
                </p>
            </div>
        </div>
    </section>
</x-public.layouts>
