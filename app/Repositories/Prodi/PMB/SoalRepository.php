<?php

namespace App\Repositories\Prodi\PMB;

use App\Models\PMB\Soal;

class SoalRepository
{
    public function getAllData()
    {
        $getSoal = 
            Soal::join(
                'pmb_token', 'pmb_soal.kode', '=', 'pmb_token.kode_soal'
            )
            ->select(
                'pmb_soal.*', 
                'pmb_token.status',
                'pmb_token.token'
            )
            ->get();
        
        return $getSoal;
    }

    public function getAllDataByJadwalUjian()
    {
        $getSoal = Soal::All();
        
        return $getSoal;
    }

    public function getAllDataByProdi($nidn)
    {
        $getSoal = 
            Soal::join(
                'pmb_token', 'pmb_soal.kode', '=', 'pmb_token.kode_soal'
            )
            ->select(
                'pmb_soal.*', 
                'pmb_token.status',
                'pmb_token.token'
            )
            ->where('pmb_soal.nidn', '=', $nidn)
            ->get();
        
        return $getSoal;
    }

    public function getSingleData($kodesoal)
    {
        $getSoal = Soal::select(
                'pmb_soal.*'
            )
            ->where('pmb_soal.kode', '=', $kodesoal)
            ->get();

        return $getSoal;
    }

    public function getSingleDataByJadwalUjian($kodesoal)
    {
        $getSoal = Soal::join(
                'pmb_token', 'pmb_soal.kode', '=', 'pmb_token.kode_soal' 
            )
            ->select(
                'pmb_soal.*', 'pmb_token.token'
            )
            ->where('pmb_soal.kode', '=', $kodesoal)
            ->get();

        return $getSoal;
    }

    public function getSingleDataForEdit($id)
    {
        $getSoal = Soal::findOrFail($id);

        return $getSoal;
    }

    public function getSingleTokenData($id)
    {
        $getSoal = 
            Soal::join(
                'pmb_token', 'pmb_soal.kode', '=', 'pmb_token.kode_soal'
            )
            ->select('pmb_token.token')
            ->where('pmb_soal.id', '=', $id)
            ->get()
            ->first();

        return $getSoal;
    }

    public function getSingleKodeSoalData($id)
    {
        $getSoal = Soal::findOrFail($id);

        return $getSoal;
    }

    public function storeSoalData($data)
    {
        $storeSoal = Soal::create($data);
        
        return $storeSoal;
    }

    public function updateSoalData($data, $id)
    {
        $updateSoal = Soal::where('id', $id)
            ->update($data);

        return $updateSoal;
    }

    public function destroySoalData($id)
    {
        $destroySoal = Soal::destroy($id);

        return $destroySoal;
    }

}
