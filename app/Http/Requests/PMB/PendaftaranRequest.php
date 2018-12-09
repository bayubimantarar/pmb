<?php

namespace App\Http\Requests\PMB;

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
            'status_pendaftaran' => 'required',
            'status' => 'required',
            'jurusan' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'kota_lahir' => 'required',
            'kelas' => 'required',
            'foto_3x4' => 'mimes:jpg,png,jpeg',
            'foto_4x6' => 'mimes:jpg,png,jpeg'
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
            'status_pendaftaran.required' => 'Status pendaftaran perlu dipilih',
            'status.required' => 'Status perlu dipilih',
            'jurusan.required' => 'Jurusan pilihan perlu dipilih',
            'nama.required' => 'Nama Lengkap perlu diisi',
            'jenis_kelamin.required' => 'Jenis kelamin perlu dipilih',
            'alamat.required' => 'Alamat perlu diisi',
            'nomor_telepon.required' => 'Nomor telepon perlu diisi',
            'email.required' => 'Email perlu diisi',
            'kelas.required' => 'Kelas perlu dipilih',
            'foto_3x4.mimes' => 'File harus bertipe [PNG/ JPG/ JPEG]',
            'foto_4x6.mimes' => 'File harus bertipe [PNG/ JPG/ JPEG]'
        ];
    }
}
