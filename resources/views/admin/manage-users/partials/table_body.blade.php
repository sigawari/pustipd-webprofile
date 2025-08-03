@forelse ($users as $key => $user)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $users->firstItem() + $key }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <img src="{{ asset('assets/img/placeholder/dummy.png') }}" alt="Gambar" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-2 border-gray-200" />
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-600 max-w-xs">{{ $user->name }}</div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-600 max-w-xs">{{ $user->email }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
            <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></div>
            {{ $user->role }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex items-center space-x-2">
            <button
                onclick="openUpdateModal('{{ $user->id }}')"
                class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50"
                title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </button>
            <button
                onclick="openDeleteModal('{{ $user->id }}')"
                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                title="Hapus">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
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
    <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
        <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
            @if ($users->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                <!-- Icon Data Kosong -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75h4.5v4.5h-4.5v-4.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h18v18H3V3z" />
                </svg>
                <span class="text-blue-500 font-medium">Belum ada data yang tersedia di sini.</span>

            @elseif ($users->isEmpty() && request()->filled('search'))
                <!-- Icon Pencarian -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                </svg>
                <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>

            @elseif ($users->isEmpty() && request()->filled('filter'))
                <!-- Icon Filter -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5a1 1 0 01-2 0v-5l-7-8V4z" />
                </svg>
                <span class="text-red-500 font-medium">Data tidak tersedia untuk filter yang dipilih.</span>
            @endif
        </div>
    </td>
</tr>
@endforelse