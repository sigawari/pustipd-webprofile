<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="public-info" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">

            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Informasi Publik
                </h2>
                <h3 class="text-lg text-secondary pt-4">
                    Informasi Publik dan dokumen terkait PUSTIPD yang bisa didownload
                </h3>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari informasi publik di sini...."
                    class="w-full rounded-xl pl-12 pr-4 py-2 sm:py-3 
               text-secondary placeholder-gray-400
               bg-white border border-white shadow-sm focus:ring-2 focus:ring-secondary focus:border-transparent
               focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" />
                <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2 text-secondary">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z" />
                    </svg>
                </button>
            </form>
        </div>
    </section>
</x-public.layouts>
