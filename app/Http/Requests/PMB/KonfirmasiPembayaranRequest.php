<?php

namespace App\Http\Requests\PMB;

use Illuminate\Foundation\Http\FormRequest;

class KonfirmasiPembayaranRequest extends FormRequest
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
            'nama'                      => 'required',
            'nomor_telepon'             => 'required',
            'email'                     => 'required',
            'alamat'                    => 'required',
            'tanggal_pembayaran'        => 'required',
            'jumlah_pembayaran'         => 'required',
            'nama_rekening_pengirim'    => 'required',
            'bukti_transaksi'           => 'max:2000|mimes:jpg,png,jpeg,gif,pdf'
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
            'alamat.required' => 'Alamat harus diisi',
            'tanggal_pembayaran.required' => 'Tanggal pembayaran harus diisi',
            'jumlah_pembayaran.required' => 'Jumlah pembayaran harus diisi',
            'nama_rekening_pengirim.required' => 'Nama rekening pengirim harus diisi',
            'bukti_transaksi.mimes' => 'Bukti transaksi harus bertipe [jpg/ png/ gif/ pdf]'
        ];
    }
}
