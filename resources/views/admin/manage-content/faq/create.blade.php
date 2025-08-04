@extends('layouts.app')

@section('content')
    @include('admin.manage-content.faq.partials.toast')

    <div class="bg-white p-6 rounded-xl border shadow-sm max-w-xl mx-auto">
        <h2 class="text-lg font-semibold mb-6">Tambah FAQ</h2>

        <form action="{{ route('admin.faq.store') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Pertanyaan</label>
                <textarea name="question" rows="2" required class="w-full border rounded-lg px-3 py-2">{{ old('question') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Jawaban</label>
                <textarea name="answer" rows="5" required class="w-full border rounded-lg px-3 py-2">{{ old('answer') }}</textarea>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Urutan</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', 0) }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" class="w-full border rounded-lg px-3 py-2">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.faq.index') }}" class="px-4 py-2 border rounded-lg">Batal</a>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
