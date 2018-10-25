<?php

namespace App\Rules\Prodi\PMB;

use Illuminate\Contracts\Validation\Rule;

class NamaFileSpreadsheet implements Rule
{
    protected $kode_soal;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($kode_soal)
    {
        $this->kode_soal = $kode_soal;
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
        return $value === $this->kode_soal.'.xlsx';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'File tidak sesuai';
    }
}
