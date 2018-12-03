<?php

namespace App\Http\Requests\Panitia;

use Illuminate\Foundation\Http\FormRequest;

class PotonganRequest extends FormRequest
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
            'deskripsi' => 'required',
            'jumlah_potongan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'deskripsi.required' => 'Deksripsi perlu diisi',
            'jumlah_potongan.required' => 'Jumlah Potongan Perlu diisi'
        ];
    }
}
