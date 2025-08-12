<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAppLayananRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'appname'     => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:draft,published,archived',
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi', // ✅ Fixed syntax
            'applink'     => 'nullable|url|max:500',
        ];
    }

    public function messages()
    {
        return [
            'appname.required'     => 'Nama aplikasi wajib diisi.',
            'appname.max'          => 'Nama aplikasi maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'status.required'      => 'Status wajib dipilih.',
            'status.in'           => 'Status harus salah satu: draft, published, archived.',
            'category.required'    => 'Kategori wajib dipilih.',
            'category.in'         => 'Kategori harus salah satu: akademik, pegawai, pembelajaran, administrasi.',
            'applink.url'         => 'Link aplikasi harus berupa URL yang valid.',
            'applink.max'         => 'Link aplikasi maksimal 500 karakter.',
        ];
    }
}
