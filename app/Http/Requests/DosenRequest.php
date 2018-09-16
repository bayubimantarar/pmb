<?php

namespace App\Http\Requests;

use App\Rules\CheckNIPDosen;
use App\Rules\CheckEmailDosen;
use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
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
                    'nip' => [
                        'required', 
                        new CheckNIPDosen
                    ],
                    'nama' => [
                        'required'
                    ],
                    'alamat' => [
                        'required'
                    ],
                    'email' => [
                        'required',
                        new CheckEmailDosen
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'nip' => [
                        'required',
                    ],
                    'nama' => [
                        'required'
                    ],
                    'alamat' => [
                        'required'
                    ],
                    'email' => [
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
            'nip.required' => 'NIP perlu diisi.',
            'nama.required' => 'Nama perlu diisi.',
            'alamat.required' => 'Alamat perlu diisi.',
            'email.required' => 'Email perlu diisi.',
        ];
    }
}
