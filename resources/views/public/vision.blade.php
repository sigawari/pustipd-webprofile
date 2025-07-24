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

        .card-visi-misi {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.08);
            padding: 3rem;
            margin-bottom: 2rem;
            border: 1px solid #e0e6f0;
            transition: box-shadow .2s;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .card-visi-misi:hover {
            box-shadow: 0 4px 24px 0 rgba(6, 39, 73, 0.08);
        }

        .card-title {
            font-size: 1.18rem;
            font-weight: 700;
            color: #062749;
            margin-bottom: 1rem;
            text-align: center;
            letter-spacing: .01em;
        }

        .card-body {
            color: #313451;
            font-size: 1.05rem;
            text-align: center;
            line-height: 1.6;
        }

        .card-body ol {
            text-align: left;
            margin-left: 1rem;
        }
    </style>

    <section id="visi-misi" class="py-20 bg-primary">
        <div class="container mx-auto px-6 md:px-12">
            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Visi Misi
                </h2>
                <h3 class="text-lg text-secondary pt-2">
                    Visi dan Misi PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>
            <!-- Kartu VISI -->
            <div class="card-visi-misi">
                <div class="card-title">
                    <h3 class="text-2xl text-secondary">Visi<h3>
                </div>
                <div class="card-body">
                    Menjadikan Teknologi Informasi sebagai media transformasi keilmuan dalam upaya mendukung pelaksanaan
                    Tri Dharma Perguruan Tinggi, dan tanggap dengan kebutuhan civitas akademika UIN Raden Fatah
                    Palembang.
                </div>
            </div>
            <!-- Kartu MISI -->
            <div class="card-visi-misi">
                <div class="card-title">
                    <h3 class="text-2xl text-secondary">Misi </h3>
                </div>
                <div class="card-body">
                    <ol class="list-decimal list-inside space-y-1 pl-3">
                        <li>Meningkatkan kualitas pengelolaan data dan informasi secara profesional.</li>
                        <li>Mengembangkan dan meningkatkan kualitas layanan teknologi informasi yang informatif dan
                            komunikatif.</li>
                        <li>Mengembangkan dan mengintegrasikan berbagai data akademik, administrasi, keuangan, dan
                            kepegawaian agar dapat diakses sesuai kebutuhan secara terbatas.</li>
                        <li>Memberikan layanan TI yang prima kepada civitas akademika secara terbatas dan optimal.</li>
                        <li>Berperan aktif meningkatkan kemampuan dan keterampilan sivitas akademika dalam bidang
                            teknologi informasi.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
</x-public.layouts>
