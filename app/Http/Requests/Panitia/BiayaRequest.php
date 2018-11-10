<?php

namespace App\Http\Requests\Panitia;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BiayaRequest extends FormRequest
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
                    'kelas' => [
                        'unique:pmb_biaya'
                    ],
                    'biaya_pendaftaran' => 'required',
                    'biaya_jaket_kemeja' => 'required',
                    'biaya_pspt' => 'required',
                    'biaya_pengembangan_institusi' => 'required',
                    'biaya_kuliah' => 'required',
                    'biaya_kemahasiswaan' => 'required'
                ];
            }
            case 'PUT' : {
                return [
                    'kelas' => [
                        Rule::unique('pmb_biaya')->ignore($this->id)
                    ],
                    'biaya_pendaftaran' => 'required',
                    'biaya_jaket_kemeja' => 'required',
                    'biaya_pspt' => 'required',
                    'biaya_pengembangan_institusi' => 'required',
                    'biaya_kuliah' => 'required',
                    'biaya_kemahasiswaan' => 'required'
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
            'kelas.unique' => 'Kelas sudah ada',
            'biaya_pendaftaran.required' => 'Biaya pendaftaran perlu diisi',
            'biaya_jaket_kemeja.required' => 'Biaya jaket dan kemeja perlu diisi',
            'biaya_pspt.required' => 'Biaya PSPT perlu diisi',
            'biaya_pengembangan_institusi.required' => 'Biaya pengembangan institusi perlu diisi',
            'biaya_kuliah.required' => 'Biaya kuliah perlu diisi',
            'biaya_kemahasiswaan.required' => 'Biaya kemahasiswaan perlu diisi'
        ];
    }
}
