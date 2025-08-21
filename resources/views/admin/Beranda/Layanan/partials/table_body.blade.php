{{-- partials/table_body.blade.php --}}
@forelse ($layanans as $key => $layanan)
    <tr class="hover:bg-gray-50 text-center">
        <!-- Checkbox -->
        <td class="px-6 py-4 whitespace-nowrap text-left">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $layanan->id }}" onchange="updateBulkActionsBar()">
        </td>
        <!-- No -->
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $layanans->firstItem() + $key }}
        </td>
        <!-- Pertanyaan -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm font-medium text-gray-900 max-w-xs">{{ Str::limit($layanan->name, 60) }}</div>
        </td>
        <!-- Jawaban -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit(strip_tags($layanan->description), 80) }}</div>
        </td>
        <!-- Status -->
        <td class="px-6 py-4 whitespace-nowrap">
            <span @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-300 text-green-800' => $layanan->status === 'published',
                'bg-yellow-300 text-yellow-800' => $layanan->status === 'draft',
            ])>
                {{ ucfirst($layanan->status) }}
            </span>
        </td>
        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">

                {{-- Publish Button --}}
                @if ($layanan->status !== 'published')
                    <button onclick="quickStatusChange('{{ $layanan->id }}', 'published')"
                        class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </button>
                @endif

                {{-- Edit Button --}}
                <button onclick="openUpdateModal('{{ $layanan->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                            m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                            v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </button>

                {{-- Delete Button --}}
                <button onclick="openDeleteModal('{{ $layanan->id }}')"
                    class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21
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
        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
            <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
                @if ($layanans->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-blue-500 font-medium">Belum ada Layanan yang tersedia.</span>
                @elseif ($layanans->isEmpty() && request()->filled('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                    </svg>
                    <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>
                @elseif ($layanans->isEmpty() && request()->filled('filter'))
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
