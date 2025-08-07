<!-- Partials/table_body.blade.php -->
@if ($galleries->count() > 0)
    @foreach ($galleries as $index => $gallery)
        <tr class="hover:bg-gray-50">
            <!-- Checkbox -->
            <td class="px-6 py-4 whitespace-nowrap">
                <input type="checkbox" value="{{ $gallery->id }}"
                    class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    onchange="updateBulkActionsBar()">
            </td>

            <!-- No -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ ($galleries->currentPage() - 1) * $galleries->perPage() + $index + 1 }}
            </td>

            <!-- Gambar (Kolom Terpisah) -->
            <td class="px-6 py-4 whitespace-nowrap">
                @if ($gallery->image && file_exists(storage_path('app/public/' . $gallery->image)))
                    <div class="flex-shrink-0 h-16 w-16">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                    </div>
                @else
                    <div
                        class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                @endif
            </td>

            <!-- Judul & Info (Kolom Terpisah) -->
            <td class="px-6 py-4">
                <div>
                    <div class="text-sm font-semibold text-gray-900">{{ $gallery->title }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ \Carbon\Carbon::parse($gallery->event_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </td>

            <!-- Status -->
            <td class="px-6 py-4 whitespace-nowrap">
                <span
                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                    @if ($gallery->status === 'published') bg-green-100 text-green-800
                    @elseif($gallery->status === 'draft') bg-yellow-100 text-yellow-800
                    @elseif($gallery->status === 'archived') bg-red-100 text-red-800 @endif">
                    {{ ucfirst($gallery->status) }}
                </span>
            </td>

            <!-- Aksi - URUTAN BARU: Published, Edit, Archived -->
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex space-x-2">
                    <!-- 1. PUBLISHED BUTTON - Tampil pertama jika belum published -->
                    @if ($gallery->status !== 'published')
                        <button onclick="quickStatusChange({{ $gallery->id }}, 'published')"
                            class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    @endif

                    <!-- 2. EDIT BUTTON - Tampil kedua -->
                    <button
                        onclick="openEditModal({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ $gallery->image }}', '{{ $gallery->event_date }}', '{{ $gallery->status }}', {{ $gallery->sort_order }})"
                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </button>

                    <!-- 3. ARCHIVED BUTTON - Tampil ketiga -->
                    @if ($gallery->status === 'archived')
                        <!-- Permanent Delete untuk status archived -->
                        <button onclick="permanentDeleteGallery({{ $gallery->id }})"
                            class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Permanen">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @else
                        <!-- Soft Delete (Archive) untuk draft/published -->
                        <button onclick="softDeleteGallery({{ $gallery->id }})"
                            class="text-orange-600 hover:text-orange-900 p-1 rounded hover:bg-orange-50"
                            title="Arsipkan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8l6 6m0 0l6-6m-6 6V3"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="px-6 py-12 text-center">
            <div class="text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <p class="text-lg font-medium text-gray-900">Belum ada gallery</p>
                <p class="text-gray-500">Tambah gallery pertama Anda</p>
                <button onclick="openAddModal()"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Tambah Gallery
                </button>
            </div>
        </td>
    </tr>
@endif
