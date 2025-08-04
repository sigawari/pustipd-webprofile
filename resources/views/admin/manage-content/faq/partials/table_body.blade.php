<tr>
    <td class="px-4 py-2">{{ Str::limit($faq->question, 60) }}</td>
    <td class="px-4 py-2">{{ Str::limit(strip_tags($faq->answer), 60) }}</td>
    <td class="px-4 py-2">{{ $faq->sort_order }}</td>
    <td class="px-4 py-2">
        <span
            class="px-2 py-1 rounded text-xs
              {{ $faq->status === 'published'
                  ? 'bg-green-100 text-green-800'
                  : ($faq->status === 'draft'
                      ? 'bg-yellow-100 text-yellow-800'
                      : 'bg-gray-100 text-gray-800') }}">
            {{ ucfirst($faq->status) }}
        </span>
    </td>
    <td class="px-4 py-2 space-x-2">
        <a href="{{ route('admin.faq.edit', $faq) }}" class="text-blue-600">Edit</a>
        <a href="{{ route('admin.faq.delete', $faq) }}" class="text-red-600">Hapus</a>
    </td>
</tr>
