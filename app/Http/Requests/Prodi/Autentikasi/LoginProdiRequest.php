<?php

namespace App\Http\Requests\Prodi\Autentikasi;

use Illuminate\Foundation\Http\FormRequest;

class LoginProdiRequest extends FormRequest
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
        return [
            'nidn' => 'required',
            'password' => 'required'
        ];
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
            'password.required' => 'Kata sandi perlu diisi'
        ];
    }
}
