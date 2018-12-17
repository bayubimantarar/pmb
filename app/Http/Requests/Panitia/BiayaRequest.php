<?php

namespace App\Http\Requests\Panitia;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BiayaRequest extends FormRequest
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
                    'kelas' => [
                        'unique:pmb_biaya'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'kelas' => [
                        Rule::unique('pmb_biaya')->ignore($this->id)
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
            'kelas.unique' => 'Kelas sudah ada'
        ];
    }
}
