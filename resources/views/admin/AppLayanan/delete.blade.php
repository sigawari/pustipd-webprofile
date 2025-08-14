<!-- Modal Hapus AppLayanan -->
@foreach ($appLayanans as $appLayanan)
    <div id="DeleteModal-{{ $appLayanan->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus {{ $title }}
            </h2>

            {{-- ✅ FIXED: Text yang sesuai --}}
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus aplikasi berikut?</p>

            {{-- ✅ FIXED: Display app info with category --}}
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-start space-x-3">
                    @php
                        $iconData = $appLayanan->category_icon;
                    @endphp
                    <div class="flex-shrink-0">
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $iconData['bg_color'] }}">
                            {{ $iconData['emoji'] }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $appLayanan->appname }}</h4>
                        <p class="text-xs text-gray-600 mt-1">Kategori: {{ $appLayanan->formatted_category }}</p>
                        @if ($appLayanan->applink)
                            <p class="text-xs text-gray-500 mt-1">Link: {{ Str::limit($appLayanan->applink, 40) }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ✅ WARNING: Action consequence --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.18 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-yellow-800">Peringatan!</p>
                        <p class="text-yellow-700">
                            Aplikasi akan diarsipkan, bukan dihapus permanen.
                            Anda masih bisa memulihkannya dari arsip.
                        </p>
                    </div>
                </div>
            </div>

            {{-- ✅ FIXED: Form action route --}}
            <form method="POST" action="{{ route('admin.app-layanan.destroy', $appLayanan->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeDeleteModal('{{ $appLayanan->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8l6 6m0 0l6-6m-6 6V3"></path>
                        </svg>
                        Arsipkan
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeDeleteModal('{{ $appLayanan->id }}')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
