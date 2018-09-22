<?php

namespace App\Repositories;

use App\Kelas;

class KelasRepository
{
    public function getAllData()
    {
        $getDosen = Kelas::All();
        
        return $getDosen;
    }

    public function getSingleData($id)
    {
        $getKelas = Kelas::findOrFail($id);

        return $getKelas;
    }

    public function storeKelasData($data)
    {
        $storeKelas = Kelas::create($data);
        
        return $storeKelas;
    }

    public function updateKelasData($data, $id)
    {
        $updateKelas = Kelas::where('id', $id)
            ->update($data);

        return $updateKelas;
    }

    public function destroyKelasData($id)
    {
        $destroyKelas = Kelas::destroy($id);

        return $destroyKelas;
    }

}
