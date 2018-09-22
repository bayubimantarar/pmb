<?php

namespace App\Rules;

use App\Kelas;
use Illuminate\Contracts\Validation\Rule;

class CheckKodeKelas implements Rule
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
        $kelas = Kelas::where('kode', $value)
            ->exists();

        if(empty($kelas)){
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
        return 'Kode kelas sudah ada';
    }
}
