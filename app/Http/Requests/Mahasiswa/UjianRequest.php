<?php

namespace App\Http\Requests\Mahasiswa;

use Illuminate\Foundation\Http\FormRequest;

class UjianRequest extends FormRequest
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
            'gambar.*' => 'mimes:jpeg,jpg,png|max:2000'
        ];
    }

    public function messages()
    {
        return [
            'gambar.*.mimes' => 'Gambar harus bertipe [JPEG/ JPG/ PNG]'
        ];
    }
}
