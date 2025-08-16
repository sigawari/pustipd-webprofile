<x-public.layouts :title="$title" :description="$description" :keywords="$keywords">
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="berita-detail" class="py-20 mt-8 bg-primary">
        <div class="container mx-auto px-3 sm:px-8 md:px-14">

            <!-- Heading Section -->
            <div class="text-center mb-10 group">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary relative inline-block underline-animate mb-3">
                    Berita
                </h2>
                <h3 class="text-lg text-secondary pt-3">
                    Berita terbaru dari PUSTIPD
                </h3>
            </div>

            <div class="news-full-article-container mx-auto">
                <h1 class="news-title-detail" id="judul-berita">
                    {{ $news->name }}
                </h1>

                <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('assets/img/placeholder/dummy.png') }}"
                    alt="{{ $news->name }}" class="news-img-detail" />

                <div class="news-date-cat mb-2 text-center">
                    {{ ucfirst(str_replace('_', ' ', $news->category)) }} &middot;
                    <span>{{ $news->publish_date ? \Carbon\Carbon::parse($news->publish_date)->format('d F Y') : '-' }}</span>
                </div>

                <!-- Share button -->
                <div class="share-btn-wrap">
                    <button class="main-share-btn" id="mainShareBtn" type="button">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z" />
                        </svg>
                        Bagikan
                    </button>
                    <div class="share-choices flex gap-4 justify-center" id="shareChoices" tabindex="0">
                        <!-- WhatsApp -->
                        <button
                            class="choice-btn p-2 rounded hover:bg-gray-800 hover:text-white transition-colors duration-200 group"
                            onclick="shareTo('wa')" type="button" title="Bagikan ke WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-800 group-hover:text-white transition-colors duration-200"
                                aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                        </button>

                        <!-- Facebook -->
                        <button
                            class="choice-btn p-2 rounded hover:bg-gray-800 hover:text-white transition-colors duration-200 group"
                            onclick="shareTo('fb')" type="button" title="Bagikan ke Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-800 group-hover:text-white transition-colors duration-200"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.4889971 2 2 6.4889971 2 12C2 17.511003 6.4889971 22 12 22C17.511003 22 22 17.511003 22 12C22 6.4889971 17.511003 2 12 2zM12 4C16.430123 4 20 7.5698774 20 12C20 16.014467 17.065322 19.313017 13.21875 19.898438L13.21875 14.384766L15.546875 14.384766L15.912109 12.019531L13.21875 12.019531L13.21875 10.726562C13.21875 9.7435625 13.538984 8.8710938 14.458984 8.8710938L15.935547 8.8710938L15.935547 6.8066406C15.675547 6.7716406 15.126844 6.6953125 14.089844 6.6953125C11.923844 6.6953125 10.654297 7.8393125 10.654297 10.445312L10.654297 12.019531L8.4277344 12.019531L8.4277344 14.384766L10.654297 14.384766L10.654297 19.878906C6.8702905 19.240845 4 15.970237 4 12C4 7.5698774 7.5698774 4 12 4z" />
                            </svg>
                        </button>

                        <!-- Instagram -->
                        <button
                            class="choice-btn p-2 rounded hover:bg-gray-800 hover:text-white transition-colors duration-200 group"
                            onclick="shareTo('ig')" type="button" title="Bagikan ke Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-800 group-hover:text-white transition-colors duration-200"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8 3C5.243 3 3 5.243 3 8L3 16C3 18.757 5.243 21 8 21L16 21C18.757 21 21 18.757 21 16L21 8C21 5.243 18.757 3 16 3L8 3zM8 5L16 5C17.654 5 19 6.346 19 8L19 16C19 17.654 17.654 19 16 19L8 19C6.346 19 5 17.654 5 16L5 8C5 6.346 6.346 5 8 5zM17 6A1 1 0 0 0 16 7A1 1 0 0 0 17 8A1 1 0 0 0 18 7A1 1 0 0 0 17 6zM12 7C9.243 7 7 9.243 7 12C7 14.757 9.243 17 12 17C14.757 17 17 14.757 17 12C17 9.243 14.757 7 12 7zM12 9C13.654 9 15 10.346 15 12C15 13.654 13.654 15 12 15C10.346 15 9 13.654 9 12C9 10.346 10.346 9 12 9z" />
                            </svg>
                        </button>

                        <!-- Telegram -->
                        <button
                            class="choice-btn p-2 rounded hover:bg-gray-800 hover:text-white transition-colors duration-200 group"
                            onclick="shareTo('tg')" type="button" title="Bagikan ke Telegram">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-7 h-7 text-gray-800 group-hover:text-white transition-colors duration-200"
                                fill="currentColor" width="100" viewBox="0 0 64 64">
                                <path
                                    d="M 32 10 C 19.85 10 10 19.85 10 32 C 10 44.15 19.85 54 32 54 C 44.15 54 54 44.15 54 32 C 54 19.85 44.15 10 32 10 z M 32 14 C 41.941 14 50 22.059 50 32 C 50 41.941 41.941 50 32 50 C 22.059 50 14 41.941 14 32 C 14 22.059 22.059 14 32 14 z M 41.041016 23.337891 C 40.533078 23.279297 39.894891 23.418531 39.181641 23.675781 C 37.878641 24.145781 21.223719 31.217953 20.261719 31.626953 C 19.350719 32.014953 18.487328 32.437828 18.486328 33.048828 C 18.486328 33.478828 18.741312 33.721656 19.445312 33.972656 C 20.177313 34.234656 22.023281 34.79275 23.113281 35.09375 C 24.163281 35.38275 25.357344 35.130844 26.027344 34.714844 C 26.736344 34.273844 34.928625 28.7925 35.515625 28.3125 C 36.102625 27.8325 36.571797 28.448688 36.091797 28.929688 C 35.611797 29.410688 29.988094 34.865094 29.246094 35.621094 C 28.346094 36.539094 28.985844 37.490094 29.589844 37.871094 C 30.278844 38.306094 35.239328 41.632016 35.986328 42.166016 C 36.733328 42.700016 37.489594 42.941406 38.183594 42.941406 C 38.877594 42.941406 39.242891 42.026797 39.587891 40.966797 C 39.992891 39.725797 41.890047 27.352062 42.123047 24.914062 C 42.194047 24.175062 41.960906 23.683844 41.503906 23.464844 C 41.365656 23.398594 41.210328 23.357422 41.041016 23.337891 z">
                                </path>
                            </svg>
                        </button>

                        <!-- Copy Link -->
                        <button
                            class="choice-btn p-2 rounded hover:bg-gray-800 hover:text-white transition-colors duration-200 group"
                            onclick="copyBeritaLink()" type="button" title="Salin Link">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-800 group-hover:text-white transition-colors duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </section>

</x-public.layouts>
