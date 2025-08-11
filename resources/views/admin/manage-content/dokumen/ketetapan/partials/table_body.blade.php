{{-- partials/table_body.blade.php --}}
@forelse ($ketetapans as $key => $ketetapan)
    <tr class="hover:bg-gray-50">
        <!-- Checkbox -->
        <td class="px-4 py-4 text-center">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $ketetapan->id }}" onchange="updateBulkActionsBar()">
        </td>

        <!-- No. -->
        <td class="px-3 py-4 text-center whitespace-nowrap">
            {{ $ketetapans->firstItem() + $key }}
        </td>

        <!-- Nama Ketetapan -->
        <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ Str::limit($ketetapan->title, 50) }}
                <br>
                @if ($ketetapan->original_filename)
                    <span class="text-xs text-gray-600">📄 {{ $ketetapan->original_filename }}</span>
                @else
                    <span class="text-xs text-gray-400">-</span>
                @endif
            </div>
        </td>

        <!-- Deskripsi -->
        <td class="px-6 py-4">
            <div class="text-sm text-gray-600 max-w-xs">
                {{ Str::limit(strip_tags($ketetapan->description), 80) }}
            </div>
        </td>

        <!-- Tahun Terbit -->
        <td class="px-3 py-4 text-center whitespace-nowrap">
            <span class="text-sm font-medium text-gray-900">
                {{ $ketetapan->year_published ?? '-' }}
            </span>
        </td>

        <!-- File Info -->
        <td class="px-6 py-4 whitespace-nowrap">
            @if ($ketetapan->file_path && $ketetapan->file_exists)
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <div class="text-xs">
                        <div class="text-green-600 font-medium">{{ strtoupper($ketetapan->file_type ?? 'FILE') }}</div>
                        @if ($ketetapan->formatted_file_size)
                            <div class="text-gray-500">{{ $ketetapan->formatted_file_size }}</div>
                        @endif
                    </div>
                </div>
            @elseif($ketetapan->file_path && !$ketetapan->file_exists)
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    <span class="text-xs text-red-600">File tidak ditemukan</span>
                </div>
            @else
                <span class="text-xs text-gray-400">Belum upload</span>
            @endif
        </td>

        <!-- Status -->
        <td class="px-3 py-4 text-center whitespace-nowrap">
            <span @class([
                'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                'bg-green-300 text-green-800' => $ketetapan->status === 'published',
                'bg-yellow-300 text-yellow-800' => $ketetapan->status === 'draft',
                'bg-gray-300 text-gray-800' => $ketetapan->status === 'archived',
            ])>
                {{ ucfirst($ketetapan->status) }}
            </span>
        </td>

        <!-- Aksi -->
        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-1">
                {{-- Quick Publish/Draft Toggle --}}
                @if ($ketetapan->status === 'published')
                    <button onclick="quickStatusChange('{{ $ketetapan->id }}', 'draft')"
                        class="p-1 text-orange-600 rounded hover:text-orange-900 hover:bg-orange-50"
                        title="Sembunyikan dari publik">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                        </svg>
                    </button>
                @else
                    <button onclick="quickStatusChange('{{ $ketetapan->id }}', 'published')"
                        class="p-1 text-green-600 rounded hover:text-green-900 hover:bg-green-50"
                        title="Publish ke publik">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                @endif

                {{-- Edit Button - menggunakan openUpdateModal dari modals.js --}}
                <button onclick="openUpdateModal('{{ $ketetapan->id }}')"
                    class="p-1 text-blue-600 rounded hover:text-blue-900 hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                              m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                              v-2.828l8.586-8.586z" />
                    </svg>
                </button>

                <button onclick="toggleVisibility(this)" data-id="{{ $ketetapan->id }}"
                    data-status="{{ $ketetapan->status }}"
                    class="p-1 rounded {{ $ketetapan->status === 'published' ? 'text-green-600 hover:text-green-900 hover:bg-green-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}"
                    title="{{ $ketetapan->status === 'published' ? 'Sembunyikan dari publik' : 'Tampilkan di publik' }}">

                    @if ($ketetapan->status === 'published')
                        {{-- Show icon (currently visible) --}}
                        <svg class="w-4 h-4 icon-show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{-- Hide Icon --}}
                        <svg class="w-4 h-4 icon-hidden hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                        </svg>
                    @else
                        {{-- Hide icon (currently hidden) --}}
                        <svg class="w-4 h-4 icon-hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                        </svg>
                        {{-- Show icon (hidden by default) --}}
                        <svg class="w-4 h-4 icon-show hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    @endif
                </button>

                {{-- Download Button --}}
                @if ($ketetapan->file_path && $ketetapan->file_exists)
                    <a href="{{ route('admin.manage-content.dokumen.ketetapan.download', $ketetapan->id) }}"
                        class="p-1 text-purple-600 rounded hover:text-purple-900 hover:bg-purple-50"
                        title="Download {{ $ketetapan->original_filename }}" target="_blank">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                        </svg>
                    </a>
                @else
                    <span class="p-1 text-gray-400 cursor-not-allowed" title="File tidak tersedia">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </span>
                @endif

                {{-- Delete Button --}}
                <button onclick="openDeleteModal('{{ $ketetapan->id }}')"
                    class="p-1 text-red-600 rounded hover:text-red-900 hover:bg-red-50" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr class="hover:bg-gray-50">
        <td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">
            <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
                @if ($ketetapans->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-blue-500 font-medium">Belum ada ketetapan yang tersedia.</span>
                    <p class="text-gray-400">Klik "Tambah Ketetapan" untuk membuat ketetapan pertama</p>
                @elseif ($ketetapans->isEmpty() && request()->filled('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                    </svg>
                    <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian untuk
                        "{{ request('search') }}"</span>
                    <p class="text-gray-400">Coba gunakan kata kunci yang berbeda</p>
                @elseif ($ketetapans->isEmpty() && request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5a1 1 0 01-2 0v-5l-7-8V4z" />
                    </svg>
                    <span class="text-red-500 font-medium">Data tidak tersedia untuk filter
                        "{{ ucfirst(request('filter')) }}"</span>
                    <p class="text-gray-400">Pilih filter yang berbada atau reset filter</p>
                @endif
            </div>
        </td>
    </tr>
@endforelse
