<?php

namespace App\Http\Requests;

use App\Rules\CheckNIMMahasiswa;
use App\Rules\CheckEmailMahasiswa;
use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
                    'nim' => [
                        'required', 
                        new CheckNIMMahasiswa
                    ],
                    'nama' => [
                        'required'
                    ],
                    'alamat' => [
                        'required'
                    ],
                    'email' => [
                        'required',
                        new CheckEmailMahasiswa
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'nim' => [
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
            'nim.required' => 'NIM perlu diisi.',
            'nama.required' => 'Nama perlu diisi.',
            'alamat.required' => 'Alamat perlu diisi.',
            'email.required' => 'Email perlu diisi.',
        ];
    }
}
