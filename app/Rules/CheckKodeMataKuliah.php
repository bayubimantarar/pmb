<?php

namespace App\Rules;

use App\MataKuliah;
use Illuminate\Contracts\Validation\Rule;

class CheckKodeMataKuliah implements Rule
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
        $matakuliah = MataKuliah::where('kode', $value)
            ->exists();

        if(empty($matakuliah)){
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
        return 'Kode mata kuliah sudah ada.';
    }
}
