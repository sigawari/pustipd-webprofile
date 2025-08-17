{{-- Share Button Component --}}
<div class="share-btn-wrap flex flex-col items-center relative">
    <!-- Tombol Bagikan Utama (Trigger) -->
    <button
        class="main-share-btn flex items-center gap-2 px-4 py-2 rounded-lg bg-secondary border border-blue-800 hover:bg-blue-800 transition-all duration-200 shadow-md hover:shadow-lg"
        id="mainShareBtn" type="button" aria-label="Bagikan">
        <!-- Share Icon (Blue Navy Stroke) -->
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="18" cy="5" r="3" />
            <circle cx="6" cy="12" r="3" />
            <circle cx="18" cy="19" r="3" />
            <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
            <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
        </svg>
        <span class="text-white font-medium hidden md:inline">Bagikan</span>
    </button>

    <!-- Popup Pilihan Share -->
    <div class="share-choices flex gap-3 justify-center items-center bg-white border border-gray-200 shadow-xl rounded-lg py-3 px-4 absolute z-10"
        id="shareChoices" tabindex="0" style="display: none; top: 56px; left: 50%; transform: translateX(-50%);" <!--
        WhatsApp -->
        <button
            class="choice-btn p-3 rounded-lg hover:bg-blue-50 group border hover:border-blue-200 transition-all duration-200 hover:-translate-y-0.5"
            data-platform="wa" data-share-text="{{ $shareText }}" data-share-url="{{ $url }}" type="button"
            title="Bagikan ke WhatsApp">
            <svg class="w-6 h-6 text-secondary group-hover:text-white transition-colors" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
            </svg>
        </button>

        <!-- Facebook -->
        <button
            class="choice-btn p-3 rounded-lg hover:bg-blue-50 group border hover:border-blue-200 transition-all duration-200 hover:-translate-y-0.5"
            data-platform="fb" data-share-text="{{ $shareText }}" data-share-url="{{ $url }}" type="button"
            title="Bagikan ke Facebook">
            <svg class="w-6 h-6 text-secondary group-hover:text-white transition-colors" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
            </svg>
        </button>

        <!-- Telegram -->
        <button
            class="choice-btn p-3 rounded-lg hover:bg-blue-50 group border hover:border-blue-200 transition-all duration-200 hover:-translate-y-0.5"
            data-platform="tg" data-share-text="{{ $shareText }}" data-share-url="{{ $url }}" type="button"
            title="Bagikan ke Telegram">
            <svg class="w-6 h-6 text-secondary group-hover:text-white transition-colors" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="m22 2-7 20-4-9-9-4z" />
                <path d="M22 2 11 13" />
            </svg>
        </button>

        <!-- Copy Link -->
        <button
            class="choice-btn p-3 rounded-lg hover:bg-blue-50 group border hover:border-blue-200 transition-all duration-200 hover:-translate-y-0.5"
            id="copyBtn" type="button" onclick="copyContentLink()" title="Salin Link">
            <svg class="w-6 h-6 text-secondary group-hover:text-white transition-colors" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
            </svg>
        </button>

        <!-- Success Message -->
        <div id="copySuccess" class="text-secondary font-medium mt-2 absolute left-1/2 -translate-x-1/2 top-full pt-2"
            style="display:none;">
            Link Disalin!
        </div>
    </div>
</div>

{{-- CSS untuk animasi transisi --}}
<style>
    .share-choices {
        opacity: 0;
        transform: translateX(-50%) translateY(10px);
        transition: opacity 0.3s ease-out, transform 0.3s ease-out;
    }

    .share-choices[style*="display: block"],
    .share-choices[style*="display: flex"] {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
</style>
