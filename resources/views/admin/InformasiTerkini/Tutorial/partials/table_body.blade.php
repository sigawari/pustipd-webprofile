<!-- Table body yang disinkronisasi -->
@forelse ($kelolaTutorials as $key => $tutorial)
    <tr class="hover:bg-gray-50 text-center">
        <!-- Checkbox -->
        <td class="px-6 py-4 whitespace-nowrap text-left">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $tutorial->id }}" onchange="updateBulkActionsBar()">
        </td>

        <!-- No -->
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $kelolaTutorials->firstItem() + $key }}
        </td>

        <!-- Kategori PUSTIPD - Updated dengan kategori yang benar -->
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $categoryData = $tutorial->category_data;
            @endphp
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $categoryData['color'] }}">
                {{ $categoryData['icon'] }} {{ $categoryData['label'] }}
            </span>
        </td>

        <!-- Title -->
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ $tutorial->title }}
            </div>
        </td>

        <!-- Content Preview - Updated untuk content blocks -->
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                @if ($tutorial->excerpt)
                    {{ Str::limit($tutorial->excerpt, 50, '...') }}
                @elseif($tutorial->content_blocks && count($tutorial->content_blocks) > 0)
                    @php
                        $firstBlock = collect($tutorial->content_blocks)->first();
                        $previewContent = '';
                        if (isset($firstBlock['title'])) {
                            $previewContent = $firstBlock['title'];
                        } elseif (isset($firstBlock['content'])) {
                            $previewContent = strip_tags($firstBlock['content']);
                        }
                    @endphp
                    {{ Str::limit($previewContent, 50, '...') }}
                @elseif($tutorial->content)
                    {{ Str::limit(strip_tags($tutorial->content), 50, '...') }}
                @else
                    <span class="text-gray-400 italic">Tidak ada konten</span>
                @endif
            </div>
        </td>

        <!-- Content Structure Info - NEW: Menampilkan info steps dan tips -->
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            @if ($tutorial->content_blocks && count($tutorial->content_blocks) > 0)
                <div class="flex flex-col space-y-1">
                    @php
                        $steps = collect($tutorial->content_blocks)->where('type', 'step')->count();
                        $tips = collect($tutorial->content_blocks)->where('type', 'tip')->count();
                    @endphp
                    @if ($steps > 0)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                            📋 {{ $steps }} langkah
                        </span>
                    @endif
                    @if ($tips > 0)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
                            💡 {{ $tips }} tips
                        </span>
                    @endif
                </div>
            @else
                <span class="text-gray-400 italic">-</span>
            @endif
        </td>

        <!-- View Count - NEW: Menampilkan jumlah views -->
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div class="flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                {{ $tutorial->view_count_human }}
            </div>
        </td>
        <!-- Status -->
        <td class="px-6 py-4 whitespace-nowrap">
            <span @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-100 text-green-800' => $tutorial->status === 'published',
                'bg-yellow-100 text-yellow-800' => $tutorial->status === 'draft',
            ])>
                {{ ucfirst($tutorial->status) }}
            </span>
        </td>

        <!-- Date -->
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ $tutorial->formatted_date ?: '-' }}
            </div>
        </td>

        <!-- Actions -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">
                <!-- Publish/Unpublish Button -->
                @if ($tutorial->status !== 'published')
                    <button onclick="quickStatusChange('{{ $tutorial->id }}', 'published')"
                        class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </button>
                @endif

                <!-- Edit Button -->
                <button onclick="openUpdateModal('{{ $tutorial->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </button>

                <!-- Delete Button -->
                <button onclick="openDeleteModal('{{ $tutorial->id }}')"
                    class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr class="hover:bg-gray-50">
        <!-- Updated colspan untuk jumlah kolom yang baru (11 kolom) -->
        <td colspan="11" class="px-6 py-4 text-center text-gray-500 italic">
            <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
                @if ($kelolaTutorials->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-blue-400 mb-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    <span class="text-blue-500 font-medium">Belum ada {{ $title ?? 'Tutorial' }} yang tersedia.</span>
                @elseif ($kelolaTutorials->isEmpty() && request()->filled('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                    </svg>
                    <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>
                @elseif ($kelolaTutorials->isEmpty() && request()->filled('filter'))
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
