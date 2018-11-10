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
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_orang_tua' => 'required',
            'nomor_telepon_orang_tua' => 'required',
            'fotocopy_raport_kelas_xii' => 'mimes:jpg,png,jpeg,pdf',
            'fotocopy_ijazah_sma' => 'mimes:jpg,png,jpeg,pdf',
            'surat_keterangan_pindah' => 'mimes:jpg,png,jpeg,pdf',
            'fotocopy_transkrip_nilai' => 'mimes:jpg,png,jpeg,pdf',
            'fotocopy_ijazah_perguruan_tinggi' => 'mimes:jpg,png,jpeg,pdf',
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
            'nama_ayah.required' => 'Nama ayah perlu diisi',
            'nama_ibu.required' => 'Nama ibu perlu diisi',
            'alamat_orang_tua.required' => 'Alamat orang tua perlu diisi',
            'nomor_telepon_orang_tua.required' => 'Nomor telepon orang tua perlu diisi',
            'kota_lahir.required' => 'Kota lahir perlu diisi'
        ];
    }    
}
