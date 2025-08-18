<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAppLayananRequest extends FormRequest
{
    public function rules()
    {
        return [
            'appname'     => 'required|string|max:255|unique:applayanan,appname', // Tambah unique check
            'description' => 'required|string|min:10',          // Tambah min length
            'status'      => 'sometimes|in:draft,published,archived', // 'sometimes' karena controller force draft
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi',
            'applink'     => 'nullable|url|max:500',
        ];
    }

    public function messages()
    {
        return [
            'appname.required'     => 'Nama aplikasi wajib diisi.',
            'appname.unique'       => 'Nama aplikasi sudah digunakan.',
            'appname.max'          => 'Nama aplikasi maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min'      => 'Deskripsi minimal 10 karakter.',
            'category.required'    => 'Kategori wajib dipilih.',
            'category.in'         => 'Kategori harus salah satu: akademik, pegawai, pembelajaran, administrasi.',
            'applink.url'         => 'Link aplikasi harus berupa URL yang valid.',
            'applink.max'         => 'Link aplikasi maksimal 500 karakter.',
        ];
    }
    
    // Override untuk force draft status sesuai workflow requirement
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        
        // Force status ke draft untuk create (sesuai conversation history requirement)
        $data['status'] = 'draft';
        
        return $data;
    }
}

