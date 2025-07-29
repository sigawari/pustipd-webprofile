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
        // Anggota Manajemen dummy
        [
            'nama' => 'Ahmad Kusuma, S.Kom.',
            'jabatan' => 'Sekretaris',
            'divisi' => 'Manajemen',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 11,
        ],
        [
            'nama' => 'Siti Nurhaliza, S.E.',
            'jabatan' => 'Bendahara',
            'divisi' => 'Manajemen',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 12,
        ],

        [
            'nama' => 'Dwi Santoso, S.Kom.',
            'jabatan' => 'Ketua Divisi Jaringan',
            'divisi' => 'Jaringan',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 2,
        ],
        // Anggota Jaringan dummy
        [
            'nama' => 'Budi Hartono, S.T.',
            'jabatan' => 'Administrator Jaringan',
            'divisi' => 'Jaringan',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 21,
        ],
        [
            'nama' => 'Eko Prasetyo, S.Kom.',
            'jabatan' => 'Network Engineer',
            'divisi' => 'Jaringan',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 22,
        ],

        [
            'nama' => 'Rina Erlina, S.T.',
            'jabatan' => 'Ketua Divisi Pengembangan Aplikasi',
            'divisi' => 'Pengembangan Aplikasi',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 3,
        ],
        // Anggota Pengembangan Aplikasi dummy
        [
            'nama' => 'Doni Setiawan, S.Kom.',
            'jabatan' => 'Frontend Developer',
            'divisi' => 'Pengembangan Aplikasi',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 31,
        ],
        [
            'nama' => 'Indah Sari, S.T.',
            'jabatan' => 'Backend Developer',
            'divisi' => 'Pengembangan Aplikasi',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 32,
        ],

        [
            'nama' => 'Joko Prasetyo, S.Kom.',
            'jabatan' => 'Ketua Divisi Pangkalan Data',
            'divisi' => 'Pangkalan Data',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 4,
        ],
        // Anggota Pangkalan Data dummy
        [
            'nama' => 'Rudi Wijaya, S.Kom.',
            'jabatan' => 'Database Administrator',
            'divisi' => 'Pangkalan Data',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 41,
        ],
        [
            'nama' => 'Maya Sari, S.T.',
            'jabatan' => 'Data Analyst',
            'divisi' => 'Pangkalan Data',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'index' => 42,
        ],
    ];

    // Mengelompokkan anggota berdasar divisi
    $groupedStruktur = [];
    foreach ($struktur as $anggota) {
        $groupedStruktur[$anggota['divisi']][] = $anggota;
    }

    // Sorting array berdasarkan index untuk setiap divisi
    foreach ($groupedStruktur as $divisi => $anggotaList) {
        usort($groupedStruktur[$divisi], function ($a, $b) {
            return $a['index'] <=> $b['index'];
        });
    }

    // Urutan divisi yang diinginkan
    $urutanDivisi = ['Manajemen', 'Jaringan', 'Pengembangan Aplikasi', 'Pangkalan Data'];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .struktur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .struktur-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .struktur-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #062749;
        }

        .struktur-card img {
            width: 200px;
            height: 250px;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            border: 4px solid #f3f4f6;
        }

        .struktur-nama {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .struktur-jabatan {
            font-size: 1rem;
            color: #6b7280;
            font-weight: 500;
        }

        .divisi-title {
            font-size: 2rem;
            font-weight: 800;
            color: #062749;
            margin-bottom: 2rem;
            margin-top: 3rem;
            text-align: center;
            position: relative;
        }

        .divisi-title:first-of-type {
            margin-top: 0;
        }

        .divisi-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #062749;
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .struktur-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .struktur-card {
                padding: 1.5rem;
            }

            .divisi-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <section id="struktur-organisasi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12 text-center max-w-7xl">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto pt-10">
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

            {{-- Loop untuk tiap divisi sesuai urutan yang diinginkan --}}
            @foreach ($urutanDivisi as $divisi)
                @if (isset($groupedStruktur[$divisi]))
                    <div class="divisi-title">{{ $divisi }}</div>
                    <div class="struktur-grid" role="list" aria-label="Anggota divisi {{ $divisi }}">
                        @foreach ($groupedStruktur[$divisi] as $anggota)
                            <div class="struktur-card" tabindex="0"
                                title="{{ $anggota['nama'] }} - {{ $anggota['jabatan'] }}">
                                <img src="{{ $anggota['image'] }}" alt="Foto {{ $anggota['nama'] }}" loading="lazy" />
                                <div class="struktur-nama">{{ $anggota['nama'] }}</div>
                                <div class="struktur-jabatan">{{ $anggota['jabatan'] }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</x-public.layouts>
