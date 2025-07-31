@php
    $faq = [
        [
            'question' => 'Apa itu PUSTIPD?',
            'answer' =>
                'PUSTIPD adalah Pusat Teknologi Informasi dan Pangkalan Data yang berfokus pada pengembangan dan pengelolaan sistem informasi di UIN Raden Fatah.',
        ],
        [
            'question' => 'Apa saja layanan yang disediakan oleh PUSTIPD?',
            'answer' =>
                'PUSTIPD menyediakan berbagai layanan seperti pengembangan aplikasi, manajemen data, pelatihan teknologi informasi, dan dukungan teknis.',
        ],
        [
            'question' => 'Bagaimana cara menghubungi PUSTIPD?',
            'answer' => 'Anda dapat menghubungi PUSTIPD melalui email di...',
        ],
    ];
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

        .faq-search {
            padding-left: 1rem;
            padding-right: 1rem;
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        .faq-card {
            background: #fff;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.07);
            transition: box-shadow .25s;
            border: 1px solid #e5e7eb;
        }

        .faq-card.active {
            box-shadow: 0 2px 16px 0 rgba(6, 39, 73, 0.08);
            border-color: #90cef1;
        }

        .faq-question {
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 1.1rem 1.35rem;
            font-weight: 700;
            color: #062749;
            font-size: 1.11rem;
        }


        .faq-answer {
            padding: 0 1.35rem 1.2rem 1.35rem;
            color: #343c55;
            font-size: 1rem;
            line-height: 1.7;
        }

        .chevron {
            transition: transform 0.35s;
            width: 1.35rem;
            height: 1.35rem;
        }

        .faq-card.active .chevron {
            transform: rotate(-180deg);
        }

        /* Slide down animation */
        .faq-answer-content {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height .38s cubic-bezier(.61, .01, .53, 1.37), opacity .28s .05s;
        }

        .faq-card.active .faq-answer-content {
            max-height: 120px;
            /* adjust for longer answer */
            opacity: 1;
        }
    </style>

    <section id="faq" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-12">

            <!-- Heading -->
            <div class="text-center mb-10 group max-w-3xl mx-auto">
                <h2
                    class="text-3xl md:text-4xl italic font-bold text-secondary relative inline-block underline-animate mb-3">
                    Frequently Asked Questions
                </h2>
                <h2 class="text-xl text-secondary pt-3 font-semibold">(FAQ)</h2>
                <h3 class="text-lg text-secondary pt-2">
                    Pertanyaan yang umum ditanyakan tentang PUSTIPD
                </h3>
            </div>

            <!-- Search Form -->
            <form action="#" method="GET" class="relative w-full max-w-md mx-auto mb-6">
                <input type="text" name="search" placeholder="Cari pertanyaan di sini...."
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

            <!-- FAQ Cards -->
            <div x-data="{
                items: @js($faq),
                open: null,
                keyword: '',
                get filtered() {
                    if (!this.keyword.trim()) return this.items;
                    return this.items.filter(item =>
                        item.question.toLowerCase().includes(this.keyword.toLowerCase()) ||
                        item.answer.toLowerCase().includes(this.keyword.toLowerCase())
                    );
                }
            }" x-init="$el.addEventListener('faq-search', e => { keyword = e.detail.keyword });">
                <template x-if="filtered.length">
                    <template x-for="(item, idx) in filtered" :key="idx">
                        <div class="faq-card" :class="{ 'active': open === idx }" :id="'faq-card-' + idx">
                            <button class="faq-question w-full text-left focus:outline-none"
                                @click="open === idx ? open = null : open = idx" type="button">
                                <span x-text="item.question"></span>
                                <svg class="chevron ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="faq-answer-content" x-ref="'faqA' + idx" x-show="open === idx" x-transition>
                                <div class="faq-answer" x-text="item.answer"></div>
                            </div>
                        </div>
                    </template>
                </template>
                <template x-if="!filtered.length">
                    <div class="text-center text-gray-500 pt-8">Pertanyaan tidak ditemukan.</div>
                </template>
            </div>
        </div>
    </section>
</x-public.layouts>
