<?php

namespace App\Repositories;

use App\Soal;
use App\Hasil;
use App\Jawaban;
use App\Mahasiswa;

class PeriksaRepository
{
    public function storeJawabanData($data)
    {
        $storeJawaban = Jawaban::insert($data);
        
        return $storeJawaban;
    }

    public function getMahasiswaCheckedAnswerByDosen($nim)
    {
        $getJawaban = Jawaban::where([
            ['nim', '=', $nim],
            ['kode_soal', '=', $kodesoal]
        ])->first();

        return $getJawaban;
    }
}
