{{-- partials/table_body.blade.php --}}
@forelse ($ketetapans as $key => $ketetapan)
    <tr class="hover:bg-gray-50">
        <!-- Checkbox -->
        <td class="px-6 py-4 whitespace-nowrap">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $ketetapan->id }}" onchange="updateBulkActionsBar()">
        </td>

        <!-- No. -->
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $ketetapans->firstItem() + $key }}
        </td>

        <!-- Nama Ketetapan -->
        <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ Str::limit($ketetapan->title, 50) }}
            </div>
            @if ($ketetapan->original_filename)
                <div class="text-xs text-gray-500 mt-1">
                    📄 {{ $ketetapan->original_filename }}
                </div>
            @endif
        </td>

        <!-- Deskripsi -->
        <td class="px-6 py-4">
            <div class="text-sm text-gray-600 max-w-xs">
                {{ Str::limit(strip_tags($ketetapan->description), 80) }}
            </div>
        </td>

        <!-- Tahun Terbit -->
        <td class="px-6 py-4 whitespace-nowrap">
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
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $statusColors = [
                    'published' => 'bg-green-100 text-green-800',
                    'draft' => 'bg-yellow-100 text-yellow-800',
                    'archived' => 'bg-gray-100 text-gray-800',
                ];
                $color = $statusColors[$ketetapan->status] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                <div class="w-1.5 h-1.5 bg-current rounded-full mr-1.5 opacity-75"></div>
                {{ ucfirst($ketetapan->status) }}
            </span>
        </td>

        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex items-center space-x-2">

                @if ($ketetapan->status === 'archived')
                    {{-- Ketetapan Archived: Restore atau Hapus Permanen --}}
                    <button onclick="quickStatusChange({{ $ketetapan->id }}, 'draft')"
                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Restore ke Draft">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </button>

                    <button onclick="permanentDeleteKetetapan({{ $ketetapan->id }})"
                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Permanen">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @else
                    {{-- Ketetapan Draft/Published: Quick Actions --}}
                    @if ($ketetapan->status === 'draft')
                        <button onclick="quickStatusChange({{ $ketetapan->id }}, 'published')"
                            class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    @elseif($ketetapan->status === 'published')
                        <button onclick="quickStatusChange({{ $ketetapan->id }}, 'draft')"
                            class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50"
                            title="Unpublish">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </button>
                    @endif

                    <!-- Download File (jika ada) -->
                    @if ($ketetapan->file_exists)
                        <a href="{{ $ketetapan->file_url }}" target="_blank"
                            download="{{ $ketetapan->original_filename }}"
                            class="text-purple-600 hover:text-purple-900 p-1 rounded hover:bg-purple-50"
                            title="Download File">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </a>
                    @endif

                    <!-- Edit -->
                    <button onclick="openUpdateModal('{{ $ketetapan->id }}')"
                        class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </button>

                    <!-- Archive -->
                    <button onclick="softDeleteKetetapan({{ $ketetapan->id }})"
                        class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-50" title="Archive">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8l6 6m0 0l6-6m-6 6V3"></path>
                        </svg>
                    </button>
                @endif
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

<script>
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
</script>
