<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MataKuliahRequest extends FormRequest
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
        switch($this->method()){
            case 'POST': {
                return [
                    'kode' => [
                        'required',
                        'unique:mata_kuliah'
                    ],
                    'nama' => [
                        'required'
                    ],
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required',
                        Rule::unique('mata_kuliah')->ignore($this->id)
                    ],
                    'nama' => [
                        'required'
                    ],
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'kode.required' => 'Kode mata kuliah perlu diisi',
            'kode.unique'   => 'Kode mata kuliah sudah ada',
            'nama.required' => 'Nama mata kuliah perlu diisi'
        ];
    }
}
