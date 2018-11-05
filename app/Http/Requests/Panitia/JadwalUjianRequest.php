<?php

namespace App\Http\Requests\Panitia;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JadwalUjianRequest extends FormRequest
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
                        'unique:pmb_jadwal_ujian'
                    ],
                    'kode_jurusan' => [
                        'required'
                    ],
                    'kode_gelombang' => [
                        'required'
                    ],
                    'kode_soal' => [
                        'required'
                    ],
                    'tahun' => [
                        'required'
                    ],
                    'tanggal_mulai_ujian' => [
                        'required'
                    ],
                    'tanggal_selesai_ujian' => [
                        'required'
                    ],
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        Rule::unique('pmb_jadwal_ujian')->ignore($this->id)
                    ],
                    'kode_jurusan' => [
                        'required'
                    ],
                    'kode_soal' => [
                        'required'
                    ],
                    'kode_gelombang' => [
                        'required'
                    ],
                    'tahun' => [
                        'required'
                    ],
                    'tanggal_mulai_ujian' => [
                        'required'
                    ],
                    'tanggal_selesai_ujian' => [
                        'required'
                    ],
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'kode.unique'                       => 'Jadwal sudah ada',
            'kode_jurusan.required'             => 'Pilih salah satu jurusan',
            'kode_soal.required'                => 'Pilih salah satu soal',
            'kode_gelombang.required'           => 'Pilih salah satu gelombang',
            'tanggal_mulai_ujian.required'      => 'Tanggal Mulai ujian perlu diisi',
            'tanggal_selesai_ujian.required'    => 'Tanggal Selesai ujian perlu diisi'
        ];
    }
}
