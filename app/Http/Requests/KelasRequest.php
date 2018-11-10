<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
                        'unique:kelas'
                    ],
                    'nama' => [
                        'required'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required',
                        Rule::unique('kelas')->ignore($this->id)
                    ],
                    'nama' => [
                        'required'
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
            'kode.required' => 'Kode kelas perlu diisi',
            'kode.unique' => 'Kode kelas sudah ada',
            'nama.required' => 'Nama kelas perlu diisi',
        ];
    }
}
