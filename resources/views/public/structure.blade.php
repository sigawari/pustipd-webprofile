@php
    $organization = [
        'name' => 'Struktur Organisasi PUSTIPD',
        'description' => $description ?? 'Struktur organisasi dan divisi PUSTIPD UIN Raden Fatah Palembang',
        'subtitle' =>
            $headData && !empty($headData->structure_desc)
                ? $headData->structure_desc
                : 'Berdasarkan surat XXX nomor XXX tentang Pengangkatan Pusat Teknologi Informasi dan Pangkalan Data Universitas Islam Negeri Raden Fatah Palembang Masa Bakti 2023-2027 menetapkan struktural organisasi sebagai berikut:',
    ];

    $head = $headData
        ? [
            'nama' => $headData->nama_kepala,
            'jabatan' => $headData->jabatan_kepala,
            'image' =>
                $headData->foto_kepala && Storage::disk('public')->exists($headData->foto_kepala)
                    ? asset('storage/' . $headData->foto_kepala)
                    : asset('assets/img/placeholder/dummy.png'),
            'email' => $headData->email_kepala ?? '',
        ]
        : [
            'nama' => '',
            'jabatan' => '',
            'image' => asset('assets/img/placeholder/dummy.png'),
            'email' => '',
        ];

    $divisions = [];
    if ($strukturData && $strukturData->count() > 0) {
        foreach ($strukturData as $divisionName => $staffs) {
            $members = [];
            foreach ($staffs as $staff) {
                $members[] = [
                    'nama' => $staff->nama,
                    'jabatan' => $staff->jabatan,
                    'image' =>
                        $staff->foto && Storage::disk('public')->exists($staff->foto)
                            ? asset('storage/' . $staff->foto)
                            : asset('assets/img/placeholder/dummy.png'),
                    'email' => $staff->email ?? '',
                ];
            }

            $divisions[] = [
                'name' => $divisionName,
                'members' => $members,
                'order' => $staffs->first()->divisi_order ?? 1,
            ];
        }

        usort($divisions, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }

    $orderDivisions = collect($divisions)->pluck('name')->toArray();
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
                    {{ $organization['name'] }}
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    {{ $organization['description'] }}
                </h3>
                <p class="text-center text-secondary mb-8 pt-3 max-w-xl mx-auto">
                    {{ $organization['subtitle'] }}
                </p>
            </div>

            <!-- Kepala Organisasi-->
            @if (!empty($head['nama']))
                <div class="mb-16 flex justify-center">
                    <x-team-card :nama="$head['nama']" :jabatan="$head['jabatan']" :foto="$head['image']" :email="$head['email']" />
                </div>
            @endif

            <!-- Struktur divisi satu per satu -->
            @if (!empty($divisions))
                @foreach ($orderDivisions as $divName)
                    @php
                        $div = collect($divisions)->firstWhere('name', $divName);
                    @endphp

                    @if ($div && !empty($div['members']))
                        <div class="mb-14">
                            <div class="divisi-tree-title mb-8">{{ $div['name'] }}</div>
                            <div class="flex justify-center gap-8 flex-wrap" role="list"
                                aria-label="Anggota divisi {{ $div['name'] }}">
                                @foreach ($div['members'] as $anggota)
                                    <x-team-card :nama="$anggota['nama']" :jabatan="$anggota['jabatan']" :foto="$anggota['image']"
                                        :email="$anggota['email']" />
                                @endforeach
                            </div>
                        </div>
                    @elseif($div)
                        <!-- Divisi ada tapi belum ada anggota -->
                        <div class="mb-14">
                            <div class="divisi-tree-title mb-8">{{ $div['name'] }}</div>
                            <div class="flex justify-center">
                                <p class="text-secondary opacity-75 italic">Anggota divisi sedang dalam proses
                                    pengangkatan</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <!-- Empty state jika belum ada divisi -->
                @if (empty($head['nama']))
                    <div class="text-center py-16">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-8 max-w-md mx-auto">
                            <svg class="mx-auto h-16 w-16 text-secondary/50 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-secondary mb-2">Struktur Organisasi Sedang
                                Dipersiapkan</h3>
                            <p class="text-secondary/75 text-sm">Data struktur organisasi akan segera dipublikasikan</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-secondary/75 italic">Struktur divisi sedang dalam proses finalisasi</p>
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-public.layouts>
