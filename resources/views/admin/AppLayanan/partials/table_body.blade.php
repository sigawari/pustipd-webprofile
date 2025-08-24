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
        <td class="px-6 py-4 whitespace-nowrap">
            <span @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-300 text-green-800' => $appLayanan->status === 'published',
                'bg-yellow-300 text-yellow-800' => $appLayanan->status === 'draft',
            ])>
                {{ ucfirst($appLayanan->status) }}
            </span>
        </td>
        
        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">
                {{-- Edit Button --}}
                <button onclick="openUpdateModal('{{ $appLayanan->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </button>

                {{-- Publish / Draft Toggle --}}
                <button onclick="toggleStatus(this)"
                    class="text-amber-600 hover:text-amber-900 p-1 rounded hover:bg-amber-50"
                    title="{{ $appLayanan->status === 'draft' ? 'Publish' : 'Unpublish' }}"
                    data-id="{{ $appLayanan->id }}"
                    data-status="{{ $appLayanan->status }}"
                    data-url="{{ route('admin.app-layanan.toggle-visibility', $appLayanan->id) }}">

                    {{-- Eye (untuk Draft → Publish) --}}
                    <svg class="size-5 icon-eye text-green-500 {{ $appLayanan->status === 'draft' ? '' : 'hidden' }}"
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
                    <svg class="size-5 icon-eye-off text-neutral-500 {{ $appLayanan->status === 'published' ? '' : 'hidden' }}"
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
