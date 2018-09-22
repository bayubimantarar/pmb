<?php

namespace App\Repositories;

use App\Dosen;

class DosenRepository
{
    public function getAllData()
    {
        $getDosen = Dosen::All();
        
        return $getDosen;
    }

    public function getSingleData($id)
    {
        $getDosen = Dosen::findOrFail($id);

        return $getDosen;
    }

    public function storeDosenData($data)
    {
        $storeDosen = Dosen::create($data);
        
        return $storeDosen;
    }

    public function updateDosenData($data, $id)
    {
        $updateDosen = Dosen::where('id', $id)
            ->update($data);

        return $updateDosen;
    }

    public function destroyDosenData($id)
    {
        $destroyDosen = Dosen::destroy($id);

        return $destroyDosen;
    }

}
