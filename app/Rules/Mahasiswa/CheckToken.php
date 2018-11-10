<?php

namespace App\Rules\Mahasiswa;

use App\Token;
use Illuminate\Contracts\Validation\Rule;

class CheckToken implements Rule
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
        $token = Token::where('token', $value)
            ->first();

        $tempstatus = $token->status;
        $temptoken = $token->token;

        if($value == $temptoken && $tempstatus == 1){
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
        return 'Token tidak ada atau soal belum diaktifkan.';
    }
}
