{{-- resources/views/components/linkList.blade.php --}}
<div class="mb-6">
    <div class="flex justify-between items-center mb-3">
        <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        <button type="button"
            onclick="addListItem('{{ $type }}', '{{ $placeholderName }}', '{{ $placeholderUrl }}')"
            class="text-sm bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah
        </button>
    </div>

    <div id="{{ $type }}-list" class="space-y-2">
        @if (isset($items) && count($items) > 0)
            @foreach ($items as $index => $item)
                <div class="flex flex-wrap items-center gap-2 p-3 bg-gray-50 rounded-lg">
                    <input type="hidden" name="{{ $type }}[{{ $index }}][id]"
                        value="{{ is_object($item) ? $item->id : $item['id'] ?? '' }}">
                    <input type="hidden" name="{{ $type }}[{{ $index }}][sort_order]" value="{{ $index }}">

                    <input type="text" name="{{ $type }}[{{ $index }}][name]"
                        value="{{ old($type . '.' . $index . '.name', is_object($item) ? $item->name : $item['name'] ?? '') }}"
                        placeholder="{{ $placeholderName }}"
                        class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">

                    <input type="url" name="{{ $type }}[{{ $index }}][url]"
                        value="{{ old($type . '.' . $index . '.url', is_object($item) ? $item->url : $item['url'] ?? '') }}"
                        placeholder="{{ $placeholderUrl }}"
                        class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">

                    <button type="button" onclick="removeListItem(this)"
                        class="text-sm text-red-600 hover:text-red-800 px-3 py-1 rounded">
                        Delete
                    </button>
                </div>
            @endforeach
        @else
            <div class="text-sm text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                {{ $emptyText }}
            </div>
        @endif
    </div>
</div>

<script>
    function addListItem(type, placeholderName, placeholderUrl) {
        const container = document.getElementById(type + '-list');
        const index = container.querySelectorAll('input[name*="[id]"]').length;

        const div = document.createElement('div');
        div.className = "flex flex-wrap items-center gap-2 p-3 bg-gray-50 rounded-lg";

        div.innerHTML = `
            <input type="hidden" name="${type}[${index}][id]" value="">
            <input type="hidden" name="${type}[${index}][sort_order]" value="${index}">
            <input type="text" name="${type}[${index}][name]" placeholder="${placeholderName}" 
                   class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">
            <input type="url" name="${type}[${index}][url]" placeholder="${placeholderUrl}" 
                   class="flex-1 min-w-[200px] px-3 py-2 border border-gray-200 rounded-lg bg-white">
            <button type="button" onclick="removeListItem(this)" 
                    class="text-sm text-red-600 hover:text-red-800 px-3 py-1 rounded">
                Delete
            </button>
        `;
        container.appendChild(div);
    }

    function removeListItem(button) {
        const container = button.closest('div.flex.flex-wrap');
        if (!container) return;

        // kalau item dari DB (punya ID) → tandai untuk dihapus
        const idInput = container.querySelector('input[name*="[id]"]');
        if (idInput && idInput.value) {
            const deletedInput = document.createElement('input');
            deletedInput.type = 'hidden';
            deletedInput.name = "deleted_ids[]";
            deletedInput.value = idInput.value;
            container.parentNode.appendChild(deletedInput);
        }

        container.remove();
    }
</script>
