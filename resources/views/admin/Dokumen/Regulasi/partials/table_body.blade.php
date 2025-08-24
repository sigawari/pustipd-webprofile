{{-- partials/table_body.blade.php --}}
@forelse ($regulasis as $key => $regulasi)
    <tr class="hover:bg-gray-50">
        <!-- Checkbox -->
        <td class="px-4 py-4 text-center">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $regulasi->id }}" onchange="updateBulkActionsBar()">
        </td>

        <!-- No. -->
        <td class="px-3 py-4 text-center whitespace-nowrap">
            {{ $regulasis->firstItem() + $key }}
        </td>

        <!-- Nama Regulasi -->
        <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ Str::limit($regulasi->title, 50) }}
                <br>
                @if ($regulasi->original_filename)
                    <span class="text-xs text-gray-600">📄 {{ $regulasi->original_filename }}</span>
                @else
                    <span class="text-xs text-gray-400">-</span>
                @endif
            </div>
        </td>

        <!-- Deskripsi -->
        <td class="px-6 py-4">
            <div class="text-sm text-gray-600 max-w-xs">
                {{ Str::limit(strip_tags($regulasi->description), 80) }}
            </div>
        </td>

        <!-- Tahun Terbit -->
        <td class="px-3 py-4 text-center whitespace-nowrap">
            <span class="text-sm font-medium text-gray-900">
                {{ $regulasi->year_published ?? '-' }}
            </span>
        </td>

        <!-- File Info -->
        <td class="px-6 py-4 whitespace-nowrap">
            @if ($regulasi->file_path && $regulasi->file_exists)
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <div class="text-xs">
                        <div class="text-green-600 font-medium">{{ strtoupper($regulasi->file_type ?? 'FILE') }}</div>
                        @if ($regulasi->formatted_file_size)
                            <div class="text-gray-500">{{ $regulasi->formatted_file_size }}</div>
                        @endif
                    </div>
                </div>
            @elseif($regulasi->file_path && !$regulasi->file_exists)
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
                'bg-green-300 text-green-800' => $regulasi->status === 'published',
                'bg-yellow-300 text-yellow-800' => $regulasi->status === 'draft',
            ])>
                {{ ucfirst($regulasi->status) }}
            </span>
        </td>

        <!-- Aksi -->
        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-1">
                {{-- Edit Button - menggunakan openUpdateModal dari modals.js --}}
                <button onclick="openUpdateModal('{{ $regulasi->id }}')"
                    class="p-1 text-blue-600 rounded hover:text-blue-900 hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                              m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                              v-2.828l8.586-8.586z" />
                    </svg>
                </button>

                {{-- Publish / Draft Toggle --}}
                <button onclick="toggleStatus(this)"
                    class="text-amber-600 hover:text-amber-900 p-1 rounded hover:bg-amber-50"
                    title="{{ $regulasi->status === 'draft' ? 'Publish' : 'Unpublish' }}"
                    data-id="{{ $regulasi->id }}"
                    data-status="{{ $regulasi->status }}"
                    data-url="{{ route('admin.dokumen.regulasi.toggle-visibility', $regulasi->id) }}">

                    {{-- Eye (untuk Draft → Publish) --}}
                    <svg class="size-5 icon-eye text-green-500 {{ $regulasi->status === 'draft' ? '' : 'hidden' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639
                            C3.423 7.51 7.36 4.5 12 4.5
                            c4.638 0 8.573 3.007 9.963 7.178
                            .07.207.07.431 0 .639
                            C20.577 16.49 16.64 19.5 12 19.5
                            c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    {{-- Eye-off (untuk Published → Draft) --}}
                    <svg class="size-5 icon-eye-off text-neutral-500 {{ $regulasi->status === 'published' ? '' : 'hidden' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12
                            C3.226 16.338 7.244 19.5 12 19.5
                            c.993 0 1.953-.138 2.863-.395M6.228 6.228
                            A10.451 10.451 0 0 1 12 4.5
                            c4.756 0 8.773 3.162 10.065 7.498
                            a10.522 10.522 0 0 1-4.293 5.774
                            M6.228 6.228 3 3m3.228 3.228
                            3.65 3.65m7.894 7.894L21 21
                            m-3.228-3.228-3.65-3.65m0 0
                            a3 3 0 1 0-4.243-4.243
                            m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>

                {{-- Download Button --}}
                @if ($regulasi->file_path && $regulasi->file_exists)
                    <a href="{{ route('admin.dokumen.regulasi.download', $regulasi->id) }}"
                        class="p-1 text-purple-600 rounded hover:text-purple-900 hover:bg-purple-50"
                        title="Download {{ $regulasi->original_filename }}" target="_blank">
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
                <button onclick="openDeleteModal('{{ $regulasi->id }}')"
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
                @if ($regulasis->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-blue-500 font-medium">Belum ada {{ $title }} yang tersedia.</span>
                    <p class="text-gray-400">Klik "Tambah {{ $title }}" untuk membuat {{ $title }}
                        pertama</p>
                @elseif ($regulasis->isEmpty() && request()->filled('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                    </svg>
                    <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian untuk
                        "{{ request('search') }}"</span>
                    <p class="text-gray-400">Coba gunakan kata kunci yang berbeda</p>
                @elseif ($regulasis->isEmpty() && request()->filled('filter'))
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
