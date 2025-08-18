<x-public.layouts :title="$title" :description="$metaDescription" :keywords="$metaKeywords">

    <section id="tutorial-detail" class="py-20 mt-8 bg-gray-50">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">
            <!-- Header -->
            <div class="text-center mb-8 group">
                <h2 class="text-4xl md:text-5xl font-bold text-secondary mb-2">Tutorial</h2>
                <h3 class="text-xl text-secondary pt-3 max-w-3xl mx-auto">
                    Panduan lengkap dan mudah diikuti dari PUSTIPD UIN Raden Fatah Palembang
                </h3>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 max-w-4xl mx-auto shadow-lg border border-gray-100">
                <h1 id="judul-tutorial" class="text-3xl font-bold text-center text-gray-800 mb-6">
                    {{ $title }}
                </h1>

                <!-- Category Badge -->
                @if (isset($tutorial) && $tutorial->category)
                    <div class="flex justify-center mb-4">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-custom-blue text-white text-sm font-semibold rounded-full shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ $tutorial->category_data['label'] ?? ucfirst(str_replace('_', ' ', $tutorial->category)) }}
                        </span>
                    </div>
                @elseif(isset($category) && $category)
                    <div class="flex justify-center mb-4">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-custom-blue text-white text-sm font-semibold rounded-full shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ ucfirst(str_replace('_', ' ', $category)) }}
                        </span>
                    </div>
                @endif

                <!-- Date -->
                <div class="text-center text-secondary font-semibold mb-7">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                    </svg>
                    <span>{{ $dateFormatted }}</span>
                </div>

                {{-- Share Buttons --}}
                <x-share-buttons :url="$url" :share-text="$shareText" />

                {{-- Content blocks --}}
                @php $stepNumber = 1; @endphp
                @foreach ($contentBlocks as $block)
                    @if ($block['type'] === 'step')
                        <div
                            class="step-block mb-10 p-8 mt-8 border-2 border-custom-blue rounded-xl bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
                            <h4 class="font-bold text-2xl mb-4 flex items-center gap-3 text-secondary">
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-custom-blue text-white w-10 h-10 text-lg font-bold shadow-md">
                                    {{ $stepNumber }}
                                </span>
                                {{ $block['title'] ?? 'Langkah ' . $stepNumber }}
                            </h4>

                            @if (!empty($block['image']))
                                <div class="mb-6">
                                    <img src="{{ asset($block['image']) }}" alt="Image step {{ $stepNumber }}"
                                        class="mx-auto max-w-full rounded-lg shadow-md border border-gray-200" />
                                </div>
                            @endif

                            <div class="prose prose-lg max-w-none">
                                <p class="leading-relaxed text-gray-700 text-lg">{{ $block['content'] }}</p>
                            </div>
                        </div>
                        @php $stepNumber++; @endphp
                    @elseif ($block['type'] === 'tip')
                        <div
                            class="tip-block mb-10 bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-8 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center">
                                        @if ($block['tip_type'] === 'tips')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                        @elseif($block['tip_type'] === 'perhatian')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                        @elseif($block['tip_type'] === 'warning')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif($block['tip_type'] === 'info')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <h5 class="text-lg font-bold text-gray-800">
                                            @if ($block['tip_type'] === 'tips')
                                                Tips Penting
                                            @elseif($block['tip_type'] === 'perhatian')
                                                Perhatian
                                            @elseif($block['tip_type'] === 'warning')
                                                Warning
                                            @elseif($block['tip_type'] === 'info')
                                                Informasi
                                            @else
                                                Tips & Highlight
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="text-gray-700 leading-relaxed">
                                        {!! nl2br(e($block['content'])) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

</x-public.layouts>
