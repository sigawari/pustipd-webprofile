@forelse ($kelolaBeritas as $key => $berita)
<tr class="hover:bg-gray-50 text-center">
    <!-- Checkbox -->
    <td class="px-6 py-4 whitespace-nowrap text-left">
        <input type="checkbox" class="item-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            value="{{ $berita->id }}" onchange="updateBulkActionsBar()">
    </td>
    <!-- No -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $kelolaBeritas->firstItem() + $key }}
    </td>

    @php
        $kategoriLabels = [
            'academic_services' => 'Layanan Akademik',
            'library_resources' => 'Perpustakaan & Sumber Daya',
            'student_information_system' => 'Sistem Informasi Mahasiswa',
            'administration' => 'Administrasi',
            'communication' => 'Komunikasi',
            'research_development' => 'Penelitian & Pengembangan',
            'other' => 'Lainnya',
        ];
    @endphp

    <!-- Kategori -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900 max-w-xs">
            {{ $kategoriLabels[$berita->category] ?? '-' }}
        </div>
    </td>

    <!-- Nama Berita -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900 max-w-xs">
            {{ $berita->name }}
        </div>
    </td>

    <!-- Konten Singkat -->
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <div class="text-sm font-medium text-gray-900 max-w-xs">
            {{ Str::limit(strip_tags($berita->content), 50, '...') }}
        </div>
    </td>

    <!-- Gambar Thumbnail -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if($berita->image)
            <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->name }}" 
                class="w-12 h-12 object-cover rounded">
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>

    <!-- Status -->
    <td class="px-6 py-4 whitespace-nowrap">
        <span
            @class([
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                'bg-green-300 text-green-800' => $berita->status === 'published',
                'bg-yellow-300 text-yellow-800' => $berita->status === 'draft',
                'bg-gray-300 text-gray-800' => $berita->status === 'archived',
            ])
        >
            {{ ucfirst($berita->status) }}
        </span>
    </td>

    <!-- Jadwal Publish -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900 max-w-xs">
            {{ $berita->publish_date ? \Carbon\Carbon::parse($berita->publish_date)->format('d M Y H:i') : '-' }}
        </div>
    </td>

    <!-- Dibuat Pada -->
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900 max-w-xs">
            {{ $berita->created_at->format('d M Y') }}
        </div>
    </td>

    <!-- Aksi -->
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex justify-center space-x-2">

            {{-- Publish Button --}}
            @if ($berita->status !== 'published')
            <button onclick="quickStatusChange('{{ $berita->id }}', 'published')"
                class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                title="Publish">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"></path>
                </svg>
            </button>
            @endif

            {{-- Edit Button --}}
            <button onclick="openUpdateModal('{{ $berita->id }}')"
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
            <button onclick="openDeleteModal('{{ $berita->id }}')"
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
    <td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">
        <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
            @if ($kelolaBeritas->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-400 mb-1"">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
            </svg>
            <span class="text-blue-500 font-medium">Belum ada {{$title}} yang tersedia.</span>
            @elseif ($kelolaBeritas->isEmpty() && request()->filled('search'))
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
            </svg>
            <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>
            @elseif ($kelolaBeritas->isEmpty() && request()->filled('filter'))
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