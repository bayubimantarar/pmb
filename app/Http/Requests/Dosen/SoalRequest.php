<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
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
                    'kode' => [
                        'unique:soal'
                    ],
                    'kode_jenis_ujian' => [
                        'required'
                    ],
                    'kode_mata_kuliah' => [
                        'required'
                    ],
                    'kode_kelas' => [
                        'required'
                    ],
                    'kode_tahun_ajaran' => [
                        'required'
                    ],
                    'sifat_ujian' => [
                        'required'
                    ],
                    'tanggal_ujian' => [
                        'required'
                    ],
                    'durasi_ujian' => [
                        'required'
                    ],
                    'jumlah_pertanyaan' => [
                        'required'
                    ]
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        Rule::unique('soal')->ignore($this->id)
                    ],
                    'kode_jenis_ujian' => [
                        'required'
                    ],
                    'kode_mata_kuliah' => [
                        'required'
                    ],
                    'kode_kelas' => [
                        'required'
                    ],
                    'kode_tahun_ajaran' => [
                        'required'
                    ],
                    'sifat_ujian' => [
                        'required'
                    ],
                    'tanggal_ujian' => [
                        'required'
                    ],
                    'durasi_ujian' => [
                        'required'
                    ],
                    'jumlah_pertanyaan' => [
                        'required'
                    ]
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'kode.unique'                   => 'Soal sudah ada',
            'kode_jenis_ujian.required'     => 'Pilih salah satu jenis ujian',
            'kode_mata_kuliah.required'     => 'Pilih salah satu mata kuliah',
            'kode_kelas.required'           => 'Pilih salah satu kelas',
            'kode_tahun_ajaran.required'    => 'Pilih salah satu tahun ajaran',
            'sifat_ujian.required'          => 'Sifat ujian perlu diisi',
            'tanggal_ujian.required'        => 'Tanggal ujian perlu diisi',
            'durasi_ujian.required'         => 'Durasi ujian perlu diisi',
            'jumlah_pertanyaan.required'    => 'Jumlah Pertanyaan perlu diisi'
        ];
    }
}
