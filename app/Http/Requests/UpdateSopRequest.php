<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   // StoreSopRequest & UpdateSopRequest
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // untuk store
            // 'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // untuk update
            'year_published' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'status' => 'nullable|in:published,draft,archived',
            // ❌ HAPUS: 'sort_order' => 'nullable|integer|min:0',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Judul Sop wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX',
            'file.max' => 'Ukuran file maksimal 10MB',
        ];
    }
}
