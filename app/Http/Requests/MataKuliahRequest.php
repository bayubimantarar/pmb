<?php

namespace App\Http\Requests;

use App\Rules\CheckKodeMataKuliah;
use Illuminate\Foundation\Http\FormRequest;

class MataKuliahRequest extends FormRequest
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
                        new CheckKodeMataKuliah
                    ],
                    'nama' => [
                        'required'
                    ],
                ];
            }
            case 'PUT' : {
                return [
                    'kode' => [
                        'required'
                    ],
                    'nama' => [
                        'required'
                    ],
                ];
            }
            default:break;
        }
    }
}
