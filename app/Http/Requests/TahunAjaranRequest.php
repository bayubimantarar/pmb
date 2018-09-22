<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
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
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required',
            'semester' => 'required'
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
            'tahun_awal.required' => 'Tahun ajaran perlu diisi.',
            'tahun_akhir.required' => 'Tahun ajaran perlu diisi.',
            'semester.required' => 'Semester ajaran perlu diisi.'
        ];
    }
}
