@php
    // Data dummy struktur
    $head = [
        'nama' => 'Awang Sugiarto, S.Kom.',
        'jabatan' => 'Kepala Bagian',
        'divisi' => 'Manajemen',
        'image' => asset('assets/img/placeholder/dummy.png'),
    ];

    $divisions = [
        [
            'name' => 'Manajemen',
            'members' => [
                [
                    'nama' => 'Ahmad Kusuma, S.Kom.',
                    'jabatan' => 'Sekretaris',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Siti Nurhaliza, S.E.',
                    'jabatan' => 'Bendahara',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Dian Agustin, S.E.',
                    'jabatan' => 'Staf Manajemen',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
            ],
        ],
        [
            'name' => 'Jaringan',
            'members' => [
                [
                    'nama' => 'Budi Hartono, S.T.',
                    'jabatan' => 'Administrator Jaringan',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Eko Prasetyo, S.Kom.',
                    'jabatan' => 'Network Engineer',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Rina Novita, S.Kom.',
                    'jabatan' => 'Staf Jaringan',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
            ],
        ],
        [
            'name' => 'Pengembangan Aplikasi',
            'members' => [
                [
                    'nama' => 'Doni Setiawan, S.Kom.',
                    'jabatan' => 'Frontend Developer',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Indah Sari, S.T.',
                    'jabatan' => 'Backend Developer',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Sulis Wulandari, S.T.',
                    'jabatan' => 'Staf Aplikasi',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
            ],
        ],
        [
            'name' => 'Pangkalan Data',
            'members' => [
                [
                    'nama' => 'Rudi Wijaya, S.Kom.',
                    'jabatan' => 'Database Administrator',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Maya Sari, S.T.',
                    'jabatan' => 'Data Analyst',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
                [
                    'nama' => 'Agus Supriyadi, S.Kom.',
                    'jabatan' => 'Staf Data',
                    'image' => asset('assets/img/placeholder/dummy.png'),
                ],
            ],
        ],
    ];

    // Urutan divisi
    $orderDivisions = ['Manajemen', 'Jaringan', 'Pengembangan Aplikasi', 'Pangkalan Data'];
@endphp

<x-public.layouts title="{{ $title }}" description="{{ $description }}" keywords="{{ $keywords }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .struktur-center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .struktur-tree-head {
            margin-bottom: 2.5rem;
        }

        .struktur-tree-divisions {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 3rem;
            margin-bottom: 3.5rem;
        }

        .struktur-divisi-grid {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
        }

        .struktur-tree-members {
            display: flex;
            flex-direction: row;
            gap: 1.1rem;
        }

        .divisi-tree-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #062749;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>

    <section id="struktur-organisasi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12 text-center max-w-7xl">
            <!-- Header dan Deskripsi -->
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

            <!-- Kepala Organisasi -->
            <div class="mb-16 flex justify-center">
                <x-team-card :name="$head['nama']" :position="$head['jabatan']" :image="$head['image']" />
            </div>

            <!-- Struktur divisi satu per satu vertikal -->
            @foreach ($orderDivisions as $divName)
                @php
                    $div = collect($divisions)->firstWhere('name', $divName);
                @endphp

                @if ($div)
                    <div class="mb-14">
                        <div class="divisi-title mb-8">{{ $div['name'] }}</div>
                        <div class="flex justify-center gap-8 flex-wrap" role="list"
                            aria-label="Anggota divisi {{ $div['name'] }}">
                            @foreach ($div['members'] as $anggota)
                                <x-team-card :name="$anggota['nama']" :position="$anggota['jabatan']" :image="$anggota['image']" />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

</x-public.layouts>
