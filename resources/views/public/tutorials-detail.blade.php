<x-public.layouts :title="$title" :description="$metaDescription" :keywords="$metaKeywords">

    <section id="tutorial-detail" class="py-20 mt-8 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">
            <!-- Header -->
            <div class="text-center mb-8 group">
                <h2 class="text-4xl md:text-5xl font-bold text-secondary mb-2">Tutorial</h2>
                <h3 class="text-xl text-secondary pt-3 max-w-3xl mx-auto">
                    Panduan lengkap dan mudah diikuti dari PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 max-w-4xl mx-auto relative">
                <h1 id="judul-tutorial" class="text-3xl font-bold text-center text-gray-800 mb-4">
                    {{ $title }}
                </h1>

                <div class="text-center text-secondary font-semibold mb-7">
                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-8 10h8" />
                    </svg>
                    <span>{{ $dateFormatted }}</span>
                </div>

                {{-- Share Buttons --}}
                <x-share-buttons :url="$url" :share-text="$shareText" />

                {{-- Content blocks --}}
                @foreach ($contentBlocks as $block)
                    @if ($block['type'] === 'step')
                        <div class="step-block mb-10 p-8 border-2 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100">
                            <h4 class="font-bold text-xl mb-3 flex items-center gap-3">
                                <span
                                    class="inline-block rounded-full bg-blue-600 text-white w-8 h-8 flex items-center justify-center">
                                    {{ $loop->iteration }}
                                </span>
                                {{ $block['title'] ?? 'Langkah ' . $loop->iteration }}
                            </h4>
                            @if (!empty($block['image']))
                                <img src="{{ asset($block['image']) }}" alt="Image step {{ $loop->iteration }}"
                                    class="mx-auto max-w-md rounded-lg mb-4" />
                            @else
                                <div
                                    class="mb-4 p-10 bg-gray-100 border-dashed border-2 border-gray-300 text-center text-gray-400">
                                    Gambar kosong (upload di CMS)
                                </div>
                            @endif
                            <p class="leading-relaxed text-lg">{{ $block['content'] }}</p>
                        </div>
                    @elseif ($block['type'] === 'tip')
                        <div
                            class="tip-block mb-10 bg-yellow-100 border-l-8 border-yellow-400 p-6 rounded border-yellow-500 text-yellow-900 italic flex items-start gap-4">
                            <span class="text-3xl"
                                style="line-height:1">{{ $block['tip_type'] === 'warning' ? '⚠️' : '💡' }}</span>
                            <div>
                                {{-- Judul tip opsional jika ada --}}
                                @if (!empty($block['title']))
                                    <h5 class="font-semibold mb-1">{{ $block['title'] }}</h5>
                                @endif
                                {!! nl2br(e($block['content'])) !!}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

</x-public.layouts>
