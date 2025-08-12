{{-- resources/views/admin/manage-content/applayanan/partials/table_body.blade.php --}}
@forelse ($appLayanans as $key => $appLayanan)
    <tr class="hover:bg-gray-50">
        <!-- Checkbox -->
        <td class="px-6 py-4 whitespace-nowrap text-left">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $appLayanan->id }}" data-status="{{ $appLayanan->status }}" onchange="updateBulkActionsBar()">
        </td>

        <!-- No -->
        <td class="px-6 py-4 whitespace-nowrap text-center">
            {{ $appLayanans->firstItem() + $key }}
        </td>

        <!-- ✅ FIXED: Kategori dengan Icon -->
        <td class="px-6 py-4 whitespace-nowrap text-center">
            @php
                $categoryData = $appLayanan->category_icon;
            @endphp
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $categoryData['bg_color'] }}">
                <span class="mr-1">{{ $categoryData['emoji'] }}</span>
                {{ $appLayanan->formatted_category }}
            </span>
        </td>

        <!-- ✅ FIXED: Nama Aplikasi -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ Str::limit($appLayanan->appname, 40) }}
            </div>
        </td>

        <!-- ✅ FIXED: Deskripsi -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm text-gray-600 max-w-xs" title="{{ $appLayanan->description }}">
                {{ Str::limit(strip_tags($appLayanan->description), 60) }}
            </div>
        </td>

        <!-- ✅ FIXED: Link Aplikasi -->
        <td class="px-6 py-4 whitespace-nowrap text-center">
            @if ($appLayanan->applink)
                <a href="{{ $appLayanan->applink }}" target="_blank"
                    class="text-blue-600 hover:text-blue-900 text-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Akses
                </a>
            @else
                <span class="text-gray-400 text-sm">-</span>
            @endif
        </td>

        <!-- Status -->
        <td class="px-6 py-4 whitespace-nowrap text-center">
            <span @class([
                'inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full',
                'bg-green-100 text-green-800' => $appLayanan->status === 'published',
                'bg-yellow-100 text-yellow-800' => $appLayanan->status === 'draft',
                'bg-gray-100 text-gray-800' => $appLayanan->status === 'archived',
            ])>
                <div class="w-1.5 h-1.5 bg-current rounded-full mr-1.5 opacity-75"></div>
                {{ ucfirst($appLayanan->status) }}
            </span>
        </td>

        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">

                {{-- ✅ IMPROVED: Quick Status Toggle --}}
                <button
                    onclick="quickStatusChange('{{ $appLayanan->id }}', '{{ $appLayanan->status == 'published' ? 'draft' : 'published' }}', '{{ $appLayanan->appname }}')"
                    class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                    title="{{ $appLayanan->status == 'published' ? 'Unpublish' : 'Publish' }}">
                    @if ($appLayanan->status == 'published')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m0 0l3-3m-3 3l3 3">
                            </path>
                        </svg>
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    @endif
                </button>

                {{-- Edit Button --}}
                <button onclick="openEditModal('{{ $appLayanan->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </button>

                {{-- ✅ ADDED: Preview Button --}}
                <button
                    onclick="previewApp('{{ $appLayanan->id }}', '{{ $appLayanan->appname }}', '{{ $appLayanan->category }}', '{{ addslashes($appLayanan->description) }}', '{{ $appLayanan->applink }}')"
                    class="text-purple-600 hover:text-purple-900 p-1 rounded hover:bg-purple-50" title="Preview">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>

                {{-- Delete Button --}}
                <button onclick="openDeleteModal('{{ $appLayanan->id }}', '{{ $appLayanan->appname }}')"
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
        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
            <div class="flex flex-col items-center justify-center py-8">
                @if (request()->filled('search'))
                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 13.65z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada hasil pencarian</h3>
                    <p class="text-gray-500">Tidak ditemukan aplikasi yang sesuai dengan pencarian
                        "{{ request('search') }}"</p>
                @elseif (request()->filled('filter'))
                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.6a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.447.894l-2 1A1 1 0 019 20v-6.586L2.293 7.307A1 1 0 012 6.6V4z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada data untuk filter ini</h3>
                    <p class="text-gray-500">Tidak ditemukan aplikasi dengan status "{{ request('filter') }}"</p>
                @else
                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada aplikasi</h3>
                    <p class="text-gray-500">Mulai dengan menambahkan aplikasi layanan pertama Anda</p>
                @endif
            </div>
        </td>
    </tr>
@endforelse
