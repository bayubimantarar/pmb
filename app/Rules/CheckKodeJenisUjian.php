<?php

namespace App\Rules;

use App\JenisUjian;
use Illuminate\Contracts\Validation\Rule;

class CheckKodeJenisUjian implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $jenisujian = JenisUjian::where('kode', $value)
            ->exists();

        if(empty($jenisujian)){
            return true;  
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kode jenis ujian sudah ada.';
    }
}
