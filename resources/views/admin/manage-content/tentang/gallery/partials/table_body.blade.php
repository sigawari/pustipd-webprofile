@forelse ($galleries as $key => $gallery)
<tr class="hover:bg-gray-50 text-center">
    <!-- Checkbox -->
     <td class="px-6 py-4 whitespace-nowrap text-left">
        <input type="checkbox" value="{{ $gallery->id }}"
            class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            onchange="updateBulkActionsBar()">
     </td>
    <!-- No -->
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $galleries->firstItem() + $key }}
    </td>
    <!-- Gambar -->
    <td class="px-6 py-4 whitespace-nowrap flex justify-center">
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

    <!-- Judul & Info Waktu -->
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
                    {{ $gallery->event_date ? $gallery->event_date->format('d M Y') : '-' }}
                </span>
            </div>
        </div>
    </td>
    <!-- Status -->
     <td class="px-6 py-4 whitespace-nowrap">
        <span
            @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-300 text-green-800' => $gallery->status === 'published',
                'bg-yellow-300 text-yellow-800' => $gallery->status === 'draft',
                'bg-gray-300 text-gray-800' => $gallery->status === 'archived',
            ])
        >
            {{ ucfirst($gallery->status) }}
        </span>

    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex flex-wrap gap-2 justify-center">
            
            {{-- Publish Button --}}
            @if ($gallery->status !== 'published')
            <button onclick="quickStatusChange('{{ $gallery->id }}', 'published')"
                class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" 
                title="Publish">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"></path>
                </svg>
            </button>
            @endif

            {{-- Edit Button --}}
            <button onclick="openUpdateModal('{{ $gallery->id }}')"    
                class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" 
                title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                        m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                        v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </button>

            {{-- Show / Hidden Toggle --}}
            <button onclick="toggleVisibility(this)" 
                class="text-amber-600 hover:text-amber-900 p-1 rounded hover:bg-amber-50" 
                title="Tampilkan/Sembunyikan">
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
                <svg class="w-4 h-4 icon-hidden hidden" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12
                        C3.226 16.338 7.244 19.5 12 19.5
                        c.993 0 1.953-.138 2.863-.395
                        M6.228 6.228A10.451 10.451 0 0 1 12 4.5
                        c4.756 0 8.773 3.162 10.065 7.498
                        a10.522 10.522 0 0 1-4.293 5.774
                        M6.228 6.228 3 3m3.228 3.228
                        3.65 3.65m7.894 7.894L21 21
                        m-3.228-3.228-3.65-3.65
                        m0 0a3 3 0 1 0-4.243-4.243
                        m4.242 4.242L9.88 9.88" />
                </svg>
            </button>

            {{-- Delete Button --}}
            <button onclick="openDeleteModal('{{ $gallery->id }}')"
                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                title="Hapus">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21
                        H7.862a2 2 0 01-1.995-1.858L5 7
                        m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1
                        h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
            </button>
        </div>
    </td>
</tr>
@empty
<tr class="hover:bg-gray-50">
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
@endforelse