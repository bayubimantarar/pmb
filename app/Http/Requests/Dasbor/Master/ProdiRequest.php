<?php

namespace App\Http\Requests\Dasbor\Master;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
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
                        'unique:master_prodi'
                    ],
                    'nama' => [
                        'required',
                        'unique:master_prodi'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required',
                        Rule::unique('master_prodi')->ignore($this->id)
                    ],
                    'nama' => [
                        'required',
                        Rule::unique('master_prodi')->ignore($this->id)
                    ]
                ];
            }
            default:break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'kode.required' => 'Kode Prodi perlu diisi',
            'kode.unique' => 'Kode Prodi sudah ada',
            'nama.required' => 'Nama prodi perlu diisi',
            'nama.unique' => 'Nama Prodi sudah ada'
        ];
    }
}
