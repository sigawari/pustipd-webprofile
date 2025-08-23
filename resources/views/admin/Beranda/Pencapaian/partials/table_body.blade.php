{{-- partials/table_body.blade.php --}}
@forelse ($pencapaians as $key => $pencapaian)
    <tr class="hover:bg-gray-50 text-center">
        <!-- Checkbox -->
        <td class="px-6 py-4 whitespace-nowrap text-left">
            <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                value="{{ $pencapaian->id }}" onchange="updateBulkActionsBar()">
        </td>
        <!-- No -->
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $pencapaians->firstItem() + $key }}
        </td>
        <!-- Pertanyaan -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm font-medium text-gray-900 max-w-xs">{{ Str::limit($pencapaian->name, 60) }}</div>
        </td>
        <!-- Jawaban -->
        <td class="px-6 py-4 text-left">
            <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit(strip_tags($pencapaian->description), 80) }}</div>
        </td>
        <!-- Status -->
        <td class="px-6 py-4 whitespace-nowrap">
            <span @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-300 text-green-800' => $pencapaian->status === 'published',
                'bg-yellow-300 text-yellow-800' => $pencapaian->status === 'draft',
            ])>
                {{ ucfirst($pencapaian->status) }}
            </span>
        </td>
        <!-- Aksi -->
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex justify-center space-x-2">

                {{-- Publish Button --}}
                @if ($pencapaian->status !== 'published')
                    <button onclick="quickStatusChange('{{ $pencapaian->id }}', 'published')"
                        class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Publish">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </button>
                @endif

                {{-- Edit Button --}}
                <button onclick="openUpdateModal('{{ $pencapaian->id }}')"
                    class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                            m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                            v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </button>

                {{-- Delete Button --}}
                <button onclick="openDeleteModal('{{ $pencapaian->id }}')"
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
    <tr>
        <td colspan="6" class="px-6 py-16 text-center">
            <div class="flex flex-col items-center justify-center space-y-4">
                @php
                    $hasSearch = request()->filled('search');
                    $hasStatusFilter = request()->filled('filter') && request('filter') !== 'all';
                    $hasCategoryFilter = request()->filled('category') && request('category') !== 'all';
                    $hasTypeFilter = request()->filled('type') && request('type') !== 'all';
                    $hasYearFilter = request()->filled('year') && request('year') !== 'all';
                    $hasAnyFilter =
                        $hasSearch || $hasStatusFilter || $hasCategoryFilter || $hasTypeFilter || $hasYearFilter;
                @endphp

                {{-- Icon --}}
                @if ($hasStatusFilter && request('filter') === 'draft')
                    <div class="text-6xl mb-2">📝</div>
                @elseif($hasStatusFilter && request('filter') === 'published')
                    <div class="text-6xl mb-2">📢</div>
                @elseif($hasTypeFilter)
                    <div class="text-6xl mb-2">🏆</div>
                @elseif($hasYearFilter)
                    <div class="text-6xl mb-2">📅</div>
                @elseif($hasCategoryFilter)
                    <div class="text-6xl mb-2">🏷️</div>
                @elseif($hasSearch)
                    <div class="text-6xl mb-2">🔍</div>
                @else
                    <div class="text-6xl mb-2">🏆</div>
                @endif

                {{-- Title & Message --}}
                @if ($hasStatusFilter && request('filter') === 'draft')
                    <div class="text-xl font-semibold text-gray-700">Belum ada Pencapaian Draft</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Semua pencapaian sudah dipublish atau belum ada data yang tersimpan
                    </div>
                @elseif($hasStatusFilter && request('filter') === 'published')
                    <div class="text-xl font-semibold text-gray-700">Belum ada Pencapaian Published</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Semua pencapaian masih dalam status draft atau belum ada data
                    </div>
                @elseif($hasTypeFilter)
                    <div class="text-xl font-semibold text-gray-700">Tidak ada pencapaian tipe
                        {{ ucfirst(request('type')) }}</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Belum ada pencapaian untuk tipe yang dipilih
                    </div>
                @elseif($hasYearFilter)
                    <div class="text-xl font-semibold text-gray-700">Tidak ada pencapaian tahun
                        {{ request('year') }}</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Belum ada pencapaian yang dicapai pada tahun yang dipilih
                    </div>
                @elseif($hasCategoryFilter)
                    <div class="text-xl font-semibold text-gray-700">Tidak ada pencapaian kategori
                        {{ ucfirst(request('category')) }}</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Belum ada pencapaian untuk kategori yang dipilih
                    </div>
                @elseif($hasSearch)
                    <div class="text-xl font-semibold text-gray-700">Tidak ditemukan</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Tidak ada pencapaian yang cocok dengan pencarian "<strong>{{ request('search') }}</strong>"
                    </div>
                @else
                    <div class="text-xl font-semibold text-gray-700">Belum ada Pencapaian</div>
                    <div class="text-gray-500 max-w-md text-center">
                        Mulai dengan menambahkan pencapaian atau prestasi pertama institusi Anda
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-6">
                    @if ($hasAnyFilter)
                        <a href="{{ route('admin.beranda.pencapaian.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset Filter
                        </a>
                    @endif

                    @if ($hasStatusFilter && request('filter') === 'published')
                        <a href="{{ route('admin.beranda.pencapaian.index', ['filter' => 'draft']) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Lihat Draft
                        </a>
                    @elseif($hasStatusFilter && request('filter') === 'draft')
                        <a href="{{ route('admin.beranda.pencapaian.index', ['filter' => 'published']) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Lihat Published
                        </a>
                    @endif

                    @if ($hasYearFilter)
                        <a href="{{ route('admin.beranda.pencapaian.index', ['year' => date('Y')]) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Lihat Tahun Ini
                        </a>
                    @endif

                    <button onclick="openAddModal()"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pencapaian
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
                            Status: {{ ucfirst(request('filter')) }}
                        @endif
                        @if ($hasTypeFilter)
                            @if ($hasSearch || $hasStatusFilter)
                                •
                            @endif
                            Tipe: {{ ucfirst(request('type')) }}
                        @endif
                        @if ($hasYearFilter)
                            @if ($hasSearch || $hasStatusFilter || $hasTypeFilter)
                                •
                            @endif
                            Tahun: {{ request('year') }}
                        @endif
                        @if ($hasCategoryFilter)
                            @if ($hasSearch || $hasStatusFilter || $hasTypeFilter || $hasYearFilter)
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
