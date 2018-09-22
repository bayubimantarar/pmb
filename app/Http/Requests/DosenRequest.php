<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
                        'unique:dosen'
                    ],
                    'nama' => [
                        'required'
                    ],
                    'alamat' => [
                        'required'
                    ],
                    'email' => [
                        'required',
                        'email',
                        'unique:dosen'
                    ],
                    'password' => [
                        'required',
                    ],
                    'password_confirmation' => [
                        'required',
                        'same:password'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'nip' => [
                        'required',
                        Rule::unique('dosen')->ignore($this->id)
                    ],
                    'nama' => [
                        'required'
                    ],
                    'alamat' => [
                        'required'
                    ],
                    'email' => [
                        'email',
                        'required',
                        Rule::unique('dosen')->ignore($this->id)
                    ],
                    'password_confirmation' => [
                        'same:password'
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
            'nip.required' => 'NIP perlu diisi',
            'nip.unique' => 'NIP sudah ada',
            'nama.required' => 'Nama perlu diisi',
            'alamat.required' => 'Alamat perlu diisi',
            'email.required' => 'Email perlu diisi',
            'email.email' => 'Email tidak sesuai format, contoh: john@mail.com',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Kata sandi perlu diisi',
            'password_confirmation.required' => 'Ulangi kata sandi perlu diisi',
            'password_confirmation.same' => 'Kata sandi tidak sama'
        ];
    }
}
