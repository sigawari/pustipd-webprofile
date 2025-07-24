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

        /* Grid container */
        .struktur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 100px;
            margin: 0 auto 3rem;
        }

        /* Kartu Struktur */
        .struktur-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgb(6 39 73 / 0.1);
            padding: 1.5rem 1rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            cursor: default;
        }

        .struktur-card:hover {
            box-shadow: 0 8px 24px rgb(6 39 73 / 0.15);
            transform: translateY(-6px);
        }

        /* Foto */
        .struktur-card img {
            width: 180px;
            height: 220px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        /* Nama */
        .struktur-nama {
            font-size: 1.1rem;
            font-weight: 700;
            color: #062749;
            margin-bottom: 0.4rem;
            text-align: center;
        }

        /* Jabatan */
        .struktur-jabatan {
            font-size: 0.9rem;
            color: #506176;
            text-align: center;
        }

        /* Judul divisi/ bagian */
        .divisi-title {
            text-align: center;
            font-weight: 700;
            font-size: 1.8rem;
            color: #062749;
            margin: 3rem auto 1rem;
            padding-bottom: 0.3rem;
            position: relative;
        }

        @media (max-width: 640px) {
            .struktur-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1.5rem;
            }

            .struktur-card img {
                width: 160px;
                height: 200px;
            }
        }
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
