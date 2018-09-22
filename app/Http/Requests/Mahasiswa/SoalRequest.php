<?php

namespace App\Http\Requests\Mahasiswa;

use App\Rules\Mahasiswa\CheckToken;
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
        return [
            'token' => ['required', new CheckToken]
        ];
    }
}
