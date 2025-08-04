@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-xl border shadow-sm max-w-md mx-auto">
        <h2 class="text-lg font-semibold mb-4">Hapus FAQ</h2>
        <p class="mb-6">Apakah Anda yakin ingin menghapus FAQ berikut?</p>
        <blockquote class="border-l-4 pl-4 italic mb-6 text-gray-600">
            {{ $faq->question }}
        </blockquote>

        <form action="{{ route('admin.faq.destroy', $faq) }}" method="post" class="flex justify-end gap-3">
            @csrf @method('DELETE')
            <a href="{{ route('admin.faq.index') }}" class="px-4 py-2 border rounded-lg">Batal</a>
            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
        </form>
    </div>
@endsection
