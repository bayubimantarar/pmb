<?php

namespace App\Http\Requests\Prodi\PMB;

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
            case 'POST' : {
                return [
                    'kode' => [
                        'unique:pmb_soal'
                    ],
                    'kode_tahun_ajaran' => [
                        'required'
                    ],
                    'tanggal_mulai_ujian' => [
                        'required'
                    ],
                    'tanggal_selesai_ujian' => [
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
                        Rule::unique('pmb_soal')->ignore($this->id)
                    ],
                    'kode_tahun_ajaran' => [
                        'required'
                    ],
                    'tanggal_mulai_ujian' => [
                        'required'
                    ],
                    'tanggal_selesai_ujian' => [
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
            'kode.unique'                       => 'Soal sudah ada',
            'kode_tahun_ajaran.required'        => 'Pilih salah satu tahun ajaran',
            'tanggal_mulai_ujian.required'      => 'Tanggal Mulai ujian perlu diisi',
            'tanggal_selesai_ujian.required'    => 'Tanggal Selesai ujian perlu diisi',
            'jumlah_pertanyaan.required'        => 'Jumlah Pertanyaan perlu diisi'
        ];
    }

}
