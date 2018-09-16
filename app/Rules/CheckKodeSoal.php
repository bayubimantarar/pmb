<?php

namespace App\Rules;

use App\Soal;
use Illuminate\Contracts\Validation\Rule;

class CheckKodeSoal implements Rule
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
        $soal = Soal::where('kode', $value)
            ->exists();

        if(empty($soal)){
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
        return 'Kode soal sudah ada.';
    }
}
