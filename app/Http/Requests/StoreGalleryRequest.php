<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'status' => 'required|in:published,draft,archived',
            'sort_order' => 'nullable|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul gallery wajib diisi',
            'image.required' => 'Gambar wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'event_date.required' => 'Tanggal kegiatan wajib diisi',
            'status.required' => 'Status wajib dipilih',
        ];
    }
}
