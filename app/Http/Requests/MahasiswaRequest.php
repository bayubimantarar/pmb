<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
                        'unique:mahasiswa'
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
                        'unique:mahasiswa'
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
                    'nim' => [
                        'required',
                        Rule::unique('mahasiswa')->ignore($this->id)
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
                        Rule::unique('mahasiswa')->ignore($this->id)
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
            'nim.required' => 'NIM perlu diisi',
            'nim.unique' => 'NIM sudah ada',
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
