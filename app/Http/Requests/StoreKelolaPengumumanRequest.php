<?php

use Illuminate\Foundation\Http\FormRequest;
// app/Http/Requests/StoreKelolaPengumumanRequest.php

class StoreKelolaPengumumanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'category'     => 'required|in:maintenance,layanan,infrastruktur,administrasi,darurat',
            'urgency'      => 'required|in:normal,penting',
            'slug'         => 'required|string|max:255|unique:kelolapengumumans,slug',
            'date'         => 'required|date',
            'valid_until'  => 'nullable|date|after:date',
            'status'       => 'required|in:draft,published,archived',
            'contact_email'=> 'nullable|email',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pengumuman wajib diisi.',
            'content.required' => 'Isi pengumuman wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori harus sesuai dengan kategori PUSTIPD.',
            'urgency.required' => 'Tingkat urgency wajib dipilih.',
            'slug.unique' => 'Slug sudah digunakan.',
            'date.required' => 'Tanggal pengumuman wajib diisi.',
            'valid_until.after' => 'Tanggal berakhir harus setelah tanggal pengumuman.',
            'contact_email.email' => 'Format email kontak tidak valid.',
        ];
    }
}
