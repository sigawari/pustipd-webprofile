@php
    $gallery = [
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Sosialisasi Sistem Informasi PUSTIPD'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Maintenance jaringan rutin'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Pelatihan Digitalisasi Kampus'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Tim IT PUSTIPD UIN Raden Fatah'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Seminar Teknologi Informasi'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Lomba Inovasi Digital'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Pendampingan UMKM Digital'],
        ['image' => asset('assets/img/placeholder/dummy.png'), 'caption' => 'Workshop Data Analytics'],
        // Tambah lagi jika perlu...
    ];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="about" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">
            <!-- Heading centered top -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Tentang PUSTIPD
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Apa itu PUSTIPD?
                </h3>
            </div>

            <!-- Content with image left and text right -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 max-w-5xl mx-auto">
                <!-- Image left -->
                <div class="flex-shrink-0 w-full lg:w-2/5">
                    <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="Banner Tentang PUSTIPD"
                        class="w-full h-full rounded-xl object-cover aspect-[2/1] shadow-md bg-gray-100" />
                </div>

                <!-- Text right -->
                <div class="content-about text-secondary text-lg w-full lg:w-3/5 text-justify">
                    <p>
                        Pusat Teknologi Informasi dan Pangkalan Data (PUSTIPD) berkedudukan di bawah koordinasi dan
                        bertanggung jawab kepada Rektor melalui Wakil Rektor II. PUSTIPD berfungsi sebagai perencana,
                        pengelola, dan pemelihara infrastruktur sistem teknologi informasi dan komunikasi serta
                        mengkoordinasi pengembangan dan integrasi aplikasi dan sistem informasi di lingkungan UIN Raden
                        Fatah Palembang serta pelaporan data ke ForlapDikti
                    </p>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-secondary mb-8 text-center">Galeri Kegiatan</h3>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach ($gallery as $idx => $item)
                        <div class="gallery-card" data-idx="{{ $idx }}">
                            <img src="{{ $item['image'] }}" alt="Galeri {{ $idx + 1 }}" class="gallery-img" />
                            <div class="caption-hover">{{ $item['caption'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal Popup for gallery -->
            <div id="gallery-popup" class="gallery-popup-bg" tabindex="-1" role="dialog" aria-modal="true"
                aria-labelledby="popup-caption">
                <div class="gallery-popup-box">
                    <div id="popup-caption" class="popup-caption"></div>
                    <img id="popup-img" class="gallery-popup-img" src="" alt="Foto galeri yang diperbesar" />
                    <button class="popup-close pt-2 pb-0.5" id="popup-close" aria-label="Tutup Galeri">Tutup</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // const gallery = @json($gallery); ini untuk apa?
    </script>
</x-public.layouts>
