<?php

namespace App\Http\Requests\Dasbor\Pengguna;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PanitiaRequest extends FormRequest
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
                    'nidn' => [
                        'required',
                        'unique:pengguna_panitia'
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
                        'unique:pengguna_panitia'
                    ],
                    'nomor_telepon' => [
                        'required',
                        'unique:pengguna_panitia'
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
                    'nidn' => [
                        'required',
                        Rule::unique('pengguna_panitia')->ignore($this->id)
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
                        Rule::unique('pengguna_panitia')->ignore($this->id)
                    ],
                    'nomor_telepon' => [
                        'required',
                        Rule::unique('pengguna_panitia')->ignore($this->id)
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
            'nidn.required' => 'NIDN perlu diisi',
            'nidn.unique' => 'NIDN sudah ada',
            'nama.required' => 'Nama perlu diisi',
            'alamat.required' => 'Alamat perlu diisi',
            'email.required' => 'Email perlu diisi',
            'email.email' => 'Email tidak sesuai format, contoh: john@mail.com',
            'email.unique' => 'Email sudah ada',
            'nomor_telepon.required' => 'Nomor telepon perlu diisi',
            'nomor_telepon.unique' => 'Nomor telepon sudah ada',
            'password.required' => 'Kata sandi perlu diisi',
            'password_confirmation.required' => 'Ulangi kata sandi perlu diisi',
            'password_confirmation.same' => 'Kata sandi tidak sama'
        ];
    }
}
