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
            <button onclick="previewAchievement(1)"
                class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                title="Preview">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
            </button>
            <button onclick="editAchievement(1)"
                class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50"
                title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </button>
            <!-- <button onclick="duplicateAchievement(1)"
                    class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-50"
                    title="Duplicate">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </button> -->
            <button onclick="deleteAchievement(1)"
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

@endforelse