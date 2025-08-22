{{-- resources/views/components/linkList.blade.php --}}
<div class="mb-6">
    <div class="flex justify-between items-center mb-3">
        <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        <button type="button"
            onclick="addListItem('{{ $type }}', '{{ $placeholderName }}', '{{ $placeholderUrl }}')"
            class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah
        </button>
    </div>

    <div id="{{ $type }}-list" class="space-y-2">
        @if (isset($items) && count($items) > 0)
            @foreach ($items as $index => $item)
                <div class="flex flex-wrap items-center gap-2 p-3 bg-gray-50 rounded-lg">
                    <input type="text" name="{{ $type }}[{{ $index }}][name]"
                        value="{{ $item['name'] ?? $item['faculty'] }}" placeholder="{{ $placeholderName }}" readonly
                        class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">

                    <input type="url" name="{{ $type }}[{{ $index }}][url]"
                        value="{{ $item['url'] }}" placeholder="{{ $placeholderUrl }}" readonly
                        class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">

                    <div class="flex gap-2">
                        <button type="button" onclick="editListItem(this)"
                            class="text-sm text-blue-600 hover:text-blue-800 px-3 py-1 rounded">Edit</button>
                        <button type="button" onclick="saveListItem(this)"
                            class="text-sm text-green-600 hover:text-green-800 px-3 py-1 rounded hidden">Save</button>
                        <button type="button" onclick="removeListItem(this)"
                            class="text-sm text-red-600 hover:text-red-800 px-3 py-1 rounded">Delete</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                {{ $emptyText }}
            </div>
        @endif
    </div>
</div>
