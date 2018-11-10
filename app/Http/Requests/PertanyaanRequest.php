<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PertanyaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pertanyaan.*' => 'required',
            'gambar.*' => 'mimes:jpeg,jpg,png|max:2000'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pertanyaan.*.required' => 'Pertanyaan Perlu diisi.',
            'gambar.*.mimes' => 'Gambar harus bertipe [JPEG/ JPG/ PNG]'
        ];
    }
}
