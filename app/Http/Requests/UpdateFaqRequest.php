<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFaqRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question'   => 'required|string',
            'answer'     => 'required|string',
            'sort_order' => [
                'nullable',
                'integer', 
                'min:1',
                Rule::unique('faqs', 'sort_order')->ignore($this->route('faq'))
            ],
            'status'     => 'required|in:draft,published,archived',
        ];
    }

    public function messages()
    {
        return [
            'sort_order.unique' => 'Urutan ini sudah digunakan, pilih nomor lain.',
            'sort_order.min'    => 'Urutan minimal dimulai dari 1.',
        ];
    }
}
