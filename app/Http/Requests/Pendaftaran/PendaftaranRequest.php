<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRequest extends FormRequest
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
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required'
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
            'nama.required' => 'Nama lengkap harus diisi',
            'nomor_telepon.required' => 'Nomor telepon harus diisi',
            'email.required' => 'Email harus diisi',
            'alamat.required' => 'Alamat harus diisi'
        ];
    }
}
