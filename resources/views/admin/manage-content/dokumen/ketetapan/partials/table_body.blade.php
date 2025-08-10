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
            <span
                @class([
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
            <div class="flex justify-center space-x-2">
                {{-- Publish Button --}}
                @if ($ketetapan->status !== 'published')
                    <button onclick="quickStatusChange('{{ $ketetapan->id }}', 'published')"
                        class="p-1 text-green-600 rounded hover:text-green-900 hover:bg-green-50"
                        title="Publish">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                @endif

                {{-- Edit Button --}}
                <button onclick="openUpdateModal('{{ $ketetapan->id }}')"
                    class="p-1 text-blue-600 rounded hover:text-blue-900 hover:bg-blue-50"
                    title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                            m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                            v-2.828l8.586-8.586z" />
                    </svg>
                </button>

                {{-- Show Button --}}
                <button class="p-1 text-amber-600 rounded hover:text-amber-900 hover:bg-amber-50"
                    title="Show">
                    <svg class="w-4 h-4 icon-show" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639
                            C3.423 7.51 7.36 4.5 12 4.5
                            c4.638 0 8.573 3.007 9.963 7.178
                            .07.207.07.431 0 .639
                            C20.577 16.49 16.64 19.5 12 19.5
                            c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                {{-- Download Button --}}
                <a href="#"
                    class="p-1 text-purple-600 rounded hover:text-purple-900 hover:bg-purple-50"
                    title="Download">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2
                            M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                </a>

                {{-- Delete Button --}}
                <button onclick="openDeleteModal('{{ $ketetapan->id }}')"
                    class="p-1 text-red-600 rounded hover:text-red-900 hover:bg-red-50"
                    title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21
                            H7.862a2 2 0 01-1.995-1.858L5 7
                            m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1
                            h-4a1 1 0 00-1 1v3M4 7h16" />
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
                    <p class="text-gray-400">Pilih filter yang berbeda atau reset filter</p>
                @endif
            </div>
        </td>
    </tr>
@endforelse

<!-- <script>
    // Quick status change untuk ketetapan
    function quickStatusChange(id, status) {
        let confirmMessage = '';

        switch (status) {
            case 'published':
                confirmMessage = 'Publish ketetapan ini ke halaman publik?';
                break;
            case 'draft':
                confirmMessage = 'Ubah ketetapan ke status draft?';
                break;
            case 'archived':
                confirmMessage = 'Arsipkan ketetapan ini?';
                break;
            default:
                confirmMessage = `Ubah status ketetapan ke ${status}?`;
        }

        if (confirm(confirmMessage)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.manage-content.dokumen.ketetapan.bulk') }}';
            form.innerHTML = `
                @csrf
                <input type="hidden" name="action" value="${status}">
                <input type="hidden" name="ids[]" value="${id}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Soft delete (archive) untuk ketetapan
    function softDeleteKetetapan(id) {
        if (confirm('Ketetapan akan diarsipkan dan bisa di-restore kembali. Lanjutkan?')) {
            quickStatusChange(id, 'archived');
        }
    }

    // Permanent delete untuk ketetapan
    function permanentDeleteKetetapan(id) {
        if (confirm(
                '⚠️ PERINGATAN!\n\nKetetapan akan dihapus PERMANEN beserta file yang terkait.\n\nData tidak dapat dikembalikan!\n\nApakah Anda yakin?'
            )) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.manage-content.dokumen.ketetapan.bulk') }}';
            form.innerHTML = `
                @csrf
                <input type="hidden" name="action" value="permanent_delete">
                <input type="hidden" name="ids[]" value="${id}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script> -->
