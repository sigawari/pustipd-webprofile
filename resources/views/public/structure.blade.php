@php
    // Data dummy struktur organisasi dengan divisi dan urutan index
    $struktur = [
        [
            'nama' => 'Awang Sugiarto, S.Kom.',
            'jabatan' => 'Kepala Bagian',
            'divisi' => 'Manajemen',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 1,
        ],
        [
            'nama' => 'Dwi Santoso, S.Kom.',
            'jabatan' => 'Ketua Divisi Jaringan',
            'divisi' => 'Jaringan',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 2,
        ],
        [
            'nama' => 'Rina Erlina, S.T.',
            'jabatan' => 'Ketua Divisi Pengembangan Aplikasi',
            'divisi' => 'Pengembangan Aplikasi',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 3,
        ],
        [
            'nama' => 'Joko Prasetyo, S.Kom.',
            'jabatan' => 'Ketua Divisi Pangkalan Data',
            'divisi' => 'Pangkalan Data',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 4,
        ],
        // Tambah anggota sesuai kebutuhan...
    ];

    // Sorting array berdasarkan index
    usort($struktur, function ($a, $b) {
        return $a['index'] <=> $b['index'];
    });

    // Mengelompokkan anggota berdasar divisi
    $groupedStruktur = [];
    foreach ($struktur as $anggota) {
        $groupedStruktur[$anggota['divisi']][] = $anggota;
    }
@endphp


<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        
    </style>

    <section id="struktur-organisasi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12 text-center max-w-7xl">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Struktur Organisasi
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Struktur organisasi dan divisi PUSTIPD UIN Raden Fatah Palembang
                </h3>
                <p class="text-center text-secondary mb-8 pt-3 max-w-xl mx-auto">
                    Berdasarkan surat XXX nomor XXX tentang Pengangkatan Pusat Teknologi Informasi dan Pangkalan Data
                    Universitas Islam Negeri Raden Fatah Palembang Masa Bakti 2023-2027 menetapkan struktural organisasi
                    sebagai berikut:
                </p>
            </div>

            {{-- Loop untuk tiap divisi --}}
            @foreach ($groupedStruktur as $divisi => $anggotaList)
                <div class="divisi-title">{{ $divisi }}</div>
                <div class="struktur-grid" role="list" aria-label="Anggota divisi {{ $divisi }}">
                    @foreach ($anggotaList as $anggota)
                        <div class="struktur-card" tabindex="0"
                            title="{{ $anggota['nama'] }} - {{ $anggota['jabatan'] }}">
                            <img src="{{ $anggota['image'] }}" alt="Foto {{ $anggota['nama'] }}" loading="lazy" />
                            <div class="struktur-nama">{{ $anggota['nama'] }}</div>
                            <div class="struktur-jabatan">{{ $anggota['jabatan'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
</x-public.layouts>
