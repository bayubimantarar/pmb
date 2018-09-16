<?php

namespace App\Http\Requests;

use App\Rules\CheckKodeSoal;
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
                        'required', 
                        new CheckKodeSoal
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
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required',
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
                ];
            }
            default:break;
        }
    }
}
