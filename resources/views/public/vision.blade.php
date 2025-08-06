<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <section id="visi-misi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Heading -->
            <div class="text-center mb-12 pt-10 pb-2 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Visi Misi
                </h2>
                <h3 class="text-lg text-secondary pt-4">
                    Visi dan Misi PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-8 max-w-4xl mx-auto">
                <!-- VISI Card -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-secondary/20 overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-secondary to-secondary/90 px-6 md:px-8 py-6 relative">
                            <div class="relative z-10 flex justify-center items-center">
                                <h3 class="text-2xl md:text-3xl font-bold text-white text-center">Visi</h3>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-8">
                            <div class="text-center">
                                <p class="text-base md:text-lg lg:text-xl text-gray-700 leading-relaxed">
                                    {{ $visiMisi->visi ?? 'Belum ada visi yang ditetapkan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MISI Card -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-secondary/20 overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-secondary/80 to-secondary px-6 md:px-8 py-6 relative">
                            <div class="relative z-10 flex justify-center items-center">
                                <h3 class="text-2xl md:text-3xl font-bold text-white text-center">Misi</h3>

                                {{-- Badge poin di pojok kanan --}}
                                @if ($visiMisi->misi && count($visiMisi->misi) > 0)
                                    <div class="absolute right-0 bg-white/20 px-3 py-1 rounded-full">
                                        <span class="text-white text-sm font-medium">{{ count($visiMisi->misi) }}
                                            Misi</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-8">
                            @if ($visiMisi->misi && count($visiMisi->misi) > 0)
                                <div class="space-y-4">
                                    @foreach ($visiMisi->misi as $index => $misiText)
                                        <!-- Desktop Layout -->
                                        <div
                                            class="hidden md:flex items-start group/item hover:bg-secondary/10 p-3 rounded-xl transition-colors duration-200">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-secondary to-secondary/80 text-white rounded-full flex items-center justify-center font-bold text-sm mr-4 mt-1">
                                                {{ $index + 1 }}
                                            </div>
                                            <p
                                                class="text-base md:text-lg text-gray-700 leading-relaxed group-hover/item:text-gray-800 transition-colors duration-200">
                                                {{ $misiText }}
                                            </p>
                                        </div>

                                        <!-- Mobile Layout - Nomor di atas, teks di bawah -->
                                        <div
                                            class="md:hidden group/item hover:bg-secondary/10 p-3 rounded-xl transition-colors duration-200">
                                            <div class="flex justify-center mb-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-r from-secondary to-secondary/80 text-white rounded-full flex items-center justify-center font-bold text-base">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <p
                                                class="text-center text-base text-gray-700 leading-relaxed group-hover/item:text-gray-800 transition-colors duration-200">
                                                {{ $misiText }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div
                                        class="w-16 h-16 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-secondary/60" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-base">Belum ada misi yang ditetapkan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-public.layouts>
