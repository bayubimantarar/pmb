<?php

namespace App\Repositories\Dasbor\Master;

use App\Models\Dasbor\Master\JadwalUjian;

class JadwalUjianPMBRepository
{
    public function getAllData()
    {
        $getJadwalUjianPMB = JadwalUjian::All();
        
        return $getJadwalUjianPMB;
    }

    public function getSingleData($id)
    {
        $getJadwalKuliah = JadwalUjian::findOrFail($id);

        return $getJadwalKuliah;
    }

    public function storeJadwalUjianPMBData($data)
    {
        $storeJadwalUjianPMBData = JadwalUjian::create($data);
        
        return $storeJadwalUjianPMBData;
    }

    public function updateJadwalKuliahData($data, $id)
    {
        $updateJadwalKuliah = JadwalUjian::where('id', $id)
            ->update($data);

        return $updateJadwalKuliah;
    }

    public function destroyJadwalUjianPMBData($id)
    {
        $destroyJadwalUjianPMB = JadwalUjian::destroy($id);

        return $destroyJadwalUjianPMB;
    }

}
