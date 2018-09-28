<?php

namespace App\Repositories;

use App\Jawaban;

class JawabanRepository
{
    public function storeJawabanData($data)
    {
        $storeJawaban = Jawaban::insert($data);
        
        return $storeJawaban;
    }

    public function checkMahasiswaHasExam($nim, $kodesoal)
    {
        $getJawaban = Jawaban::where([
            [
                'kode_soal', '=', $kodesoal
            ],
            [
                'nim', '=', $nim
            ]
        ])
        ->firstOrFail();
    }
}
