<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Biaya;

class BiayaRepository
{
    public function getAllData()
    {
        $getBiaya = Biaya::All();
        
        return $getBiaya;
    }

    public function getSingleData($id)
    {
        $getBiayaData = Biaya::findOrFail($id);

        return $getBiayaData;
    }

    public function getSingleDataForBiaya($kodeKelas)
    {
        $getBiayaData = Biaya::where('id', '=', $kodeKelas)
            ->get()
            ->first();

        return $getBiayaData;
    }

    public function storeBiayaData($data)
    {
        $storeBiayaData = Biaya::create($data);
        
        return $storeBiayaData;
    }

    public function updateBiayaData($data, $id)
    {
        $updateBiayaData = Biaya::where('id', $id)
            ->update($data);

        return $updateBiayaData;
    }

    public function destroyBiayaData($id)
    {
        $destroyBiayaData = Biaya::destroy($id);

        return $destroyBiayaData;
    }

}
