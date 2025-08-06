{{-- partials/table_body.blade.php --}}
@forelse ($gallery as $key => $gallery)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $gallery->id }}" onchange="updateBulkActionsBar()">
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $gallery->firstItem() + $key }}
        </td>
        <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900 max-w-xs">{{ Str::limit($gallery->image, 60) }}</div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit(strip_tags($gallery->description), 80) }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="text-sm text-gray-900">{{ $gallery->sort_order }}</span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $statusColors = [
                    'published' => 'bg-green-100 text-green-800',
                    'draft' => 'bg-yellow-100 text-yellow-800',
                    'archived' => 'bg-gray-100 text-gray-800',
                ];
                $color = $statusColors[$gallery->status] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                <div class="w-1.5 h-1.5 bg-current rounded-full mr-1.5 opacity-75"></div>
                {{ ucfirst($gallery->status) }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex items-center space-x-2">

                @if ($gallery->status === 'archived')
                    {{-- FAQ Archived: Restore atau Hapus Permanen --}}
                    <button onclick="quickStatusChange({{ $gallery->id }}, 'draft')"
                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Restore ke Draft">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </button>

                    <button onclick="permanentDeleteFaq({{ $gallery->id }})"
                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Permanen">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @else
                    {{-- FAQ Draft/Published: Quick Actions --}}
                    @if ($gallery->status === 'draft')
                        <button onclick="quickStatusChange({{ $gallery->id }}, 'published')"
                            class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    @elseif($gallery->status === 'published')
                        <button onclick="quickStatusChange({{ $gallery->id }}, 'draft')"
                            class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50"
                            title="Unpublish">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </button>
                    @endif

                    <!-- Edit -->
                    <button onclick="openUpdateModal('{{ $gallery->id }}')"
                        class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </button>

                    <!-- Archive -->
                    <button onclick="softDeleteFaq({{ $gallery->id }})"
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
        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
            <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
                @if ($gallery->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-blue-500 font-medium">Belum ada FAQ yang tersedia.</span>
                @elseif ($gallery->isEmpty() && request()->filled('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                    </svg>
                    <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>
                @elseif ($gallery->isEmpty() && request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5a1 1 0 01-2 0v-5l-7-8V4z" />
                    </svg>
                    <span class="text-red-500 font-medium">Data tidak tersedia untuk filter yang dipilih.</span>
                @endif
            </div>
        </td>
    </tr>
@endforelse

<script>
    // Quick status change
    function quickStatusChange(id, status) {
        if (confirm(`Ubah status FAQ ke ${status}?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.manage-content.faq.bulk') }}';
            form.innerHTML = `
                @csrf
                <input type="hidden" name="action" value="${status}">
                <input type="hidden" name="ids[]" value="${id}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Soft delete (archive)
    function softDeleteFaq(id) {
        if (confirm('FAQ akan diarsipkan, bukan dihapus permanen. Lanjutkan?')) {
            quickStatusChange(id, 'archived');
        }
    }
</script>
