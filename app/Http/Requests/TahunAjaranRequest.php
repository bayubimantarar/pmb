<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
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
                        'unique:tahun_ajaran'
                    ],
                    'tahun_awal' => [
                        'required'
                    ],
                    'tahun_akhir' => [
                        'required'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        Rule::unique('tahun_ajaran')->ignore($this->id)
                    ],
                    'tahun_awal' => [
                        'required'
                    ],
                    'tahun_akhir' => [
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
            'kode.unique'           => 'Kode tahun ajaran sudah ada',
            'tahun_awal.required'   => 'Tahun ajaran perlu diisi.',
            'tahun_akhir.required'  => 'Tahun ajaran perlu diisi.'
        ];
    }
}
