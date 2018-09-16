<?php

namespace App\Rules;

use App\Mahasiswa;
use Illuminate\Contracts\Validation\Rule;

class CheckEmailMahasiswa implements Rule
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
        $mahasiswa = Mahasiswa::where('email', $value)
            ->exists();

        if(empty($mahasiswa)){
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
        return 'Email sudah ada.';
    }
}
