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
            {{-- PERBAIKAN: Handle ketika firstItem() null --}}
            {{ ($appLayanans->firstItem() ?? 0) + $key }}
        </td>


        <td class="px-6 py-4 whitespace-nowrap text-center">
            @php
                $categoryData = $appLayanan->category_data;
            @endphp
            <div class="flex items-center justify-center">
                <span
                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $categoryData['bg_color'] }}">
                    {{ $categoryData['emoji'] }} {{ $categoryData['label'] }}
                </span>
            </div>
        </td>

        <!--  Nama Aplikasi -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm font-medium text-gray-900 max-w-xs">
                {{ Str::limit($appLayanan->appname, 40) }}
            </div>
        </td>

        <!--  Deskripsi -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm text-gray-600 max-w-xs" title="{{ $appLayanan->description }}">
                {{ Str::limit(strip_tags($appLayanan->description), 60) }}
            </div>
        </td>

        <!--  Link Aplikasi -->
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
            ])>
                <div class="w-1.5 h-1.5 bg-current rounded-full mr-1.5 opacity-75"></div>
                {{ ucfirst($appLayanan->status) }}
            </span>
        </td>

        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">

                {{-- Quick Publish/Draft Toggle --}}
                @if ($appLayanan->status === 'published')
                    <button onclick="quickStatusChange('{{ $appLayanan->id }}', 'draft')"
                        class="p-1 text-orange-600 rounded hover:text-orange-900 hover:bg-orange-50"
                        title="Sembunyikan dari publik">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                @else
                    <button onclick="quickStatusChange('{{ $appLayanan->id }}', 'published')"
                        class="p-1 text-green-600 rounded hover:text-green-900 hover:bg-green-50"
                        title="Publish ke publik">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                @endif

                {{-- Edit Button --}}
                <button onclick="openUpdateModal('{{ $appLayanan->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
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
    <tr>
        <td colspan="8" class="px-6 py-16 text-center">
            <div class="flex flex-col items-center justify-center space-y-4">
                @php
                    $hasSearch = request()->filled('search');
                    $hasStatusFilter = request()->filled('status') && request('status') !== 'all';
                    $hasCategoryFilter = request()->filled('category') && request('category') !== 'all';
                    $hasAnyFilter = $hasSearch || $hasStatusFilter || $hasCategoryFilter;
                @endphp

                {{-- Icon --}}
                @if ($hasStatusFilter && request('status') === 'draft')
                    <div class="text-6xl mb-2">📝</div>
                @elseif($hasStatusFilter && request('status') === 'published')
                    <div class="text-6xl mb-2">📢</div>
                @elseif($hasCategoryFilter)
                    <div class="text-6xl mb-2">🏷️</div>
                @elseif($hasSearch)
                    <div class="text-6xl mb-2">🔍</div>
                @else
                    <div class="text-6xl mb-2">📱</div>
                @endif

                {{-- Title & Message --}}
                @if ($hasStatusFilter && request('status') === 'draft')
                    <div class="text-xl font-semibold text-gray-700">Belum ada aplikasi Draft</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Semua aplikasi sudah dipublish atau belum ada data yang tersimpan
                    </div>
                @elseif($hasStatusFilter && request('status') === 'published')
                    <div class="text-xl font-semibold text-gray-700">Belum ada aplikasi Published</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Semua aplikasi masih dalam status draft atau belum ada data
                    </div>
                @elseif($hasCategoryFilter)
                    <div class="text-xl font-semibold text-gray-700">Tidak ada aplikasi kategori
                        {{ ucfirst(request('category')) }}</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Belum ada aplikasi layanan untuk kategori yang dipilih
                    </div>
                @elseif($hasSearch)
                    <div class="text-xl font-semibold text-gray-700">Tidak ditemukan</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Tidak ada aplikasi yang cocok dengan pencarian "<strong>{{ request('search') }}</strong>"
                    </div>
                @else
                    <div class="text-xl font-semibold text-gray-700">Belum ada aplikasi layanan</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Mulai dengan menambahkan aplikasi layanan pertama untuk institusi Anda
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-6">
                    @if ($hasAnyFilter)
                        <a href="{{ route('admin.app-layanan.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset Filter
                        </a>
                    @endif

                    @if ($hasStatusFilter && request('status') === 'published')
                        <a href="{{ route('admin.app-layanan.index', ['status' => 'draft']) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Lihat Draft
                        </a>
                    @elseif($hasStatusFilter && request('status') === 'draft')
                        <a href="{{ route('admin.app-layanan.index', ['status' => 'published']) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Lihat Published
                        </a>
                    @endif

                    <button onclick="openAddModal()"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Aplikasi
                    </button>
                </div>

                {{-- Filter Info --}}
                @if ($hasAnyFilter)
                    <div class="text-xs text-gray-400 mt-4 p-3 bg-gray-50 rounded-lg">
                        <strong>Filter aktif:</strong>
                        @if ($hasSearch)
                            Pencarian: "{{ request('search') }}"
                        @endif
                        @if ($hasStatusFilter)
                            @if ($hasSearch)
                                •
                            @endif
                            Status: {{ ucfirst(request('status')) }}
                        @endif
                        @if ($hasCategoryFilter)
                            @if ($hasSearch || $hasStatusFilter)
                                •
                            @endif
                            Kategori: {{ ucfirst(request('category')) }}
                        @endif
                    </div>
                @endif
            </div>
        </td>
    </tr>
@endforelse
