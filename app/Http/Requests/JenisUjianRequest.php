<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JenisUjianRequest extends FormRequest
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
                        'unique:jenis_ujian'
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
                        Rule::unique('jenis_ujian')->ignore($this->id)
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
            'kode.required' => 'Kode jenis ujian perlu diisi',
            'kode.unique'   => 'Kode jenis ujian sudah ada',
            'nama.required' => 'Nama jenis ujian perlu diisi'
        ];
    }
}
