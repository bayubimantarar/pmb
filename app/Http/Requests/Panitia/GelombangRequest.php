<?php

namespace App\Http\Requests\Panitia;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GelombangRequest extends FormRequest
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
                        'required',
                        'unique:pmb_gelombang'
                    ],
                    'nama' => 'required',
                    'dari_tanggal' => 'required',
                    'sampai_tanggal' => 'required'
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required',
                        Rule::unique('pmb_gelombang')->ignore($this->id)
                    ],
                    'nama' => 'required',
                    'dari_tanggal' => 'required',
                    'sampai_tanggal' => 'required'
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
            'kode.required' => 'Kode sudah',
            'kode.unique' => 'Gelombang sudah ada',
            'nama.required' => 'Nama gelombang perlu dipilih',
            'dari_tanggal.required' => 'Dari tanggal perlu diisi',
            'sampai_tanggal.required' => 'Sampai tanggal perlu diisi',
        ];
    }
}
