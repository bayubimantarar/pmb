<?php

namespace App\Repositories\Dasbor\Pengguna;

use App\Models\Dasbor\Pengguna\Prodi;

class ProdiRepository
{
    public function getAllData()
    {
        $getProdiData = Prodi::All();
        
        return $getProdiData;
    }

    public function getSingleData($id)
    {
        $getProdiData = Prodi::findOrFail($id);

        return $getProdiData;
    }

    public function storeProdiData($data)
    {
        $storeProdiData = Prodi::create($data);
        
        return $storeProdiData;
    }

    public function updateProdiData($data, $id)
    {
        $updateupdateProdiData = Prodi::where('id', $id)
            ->update($data);

        return $updateupdateProdiData;
    }

    public function destroyProdiData($id)
    {
        $destroyProdiData = Prodi::destroy($id);

        return $destroyProdiData;
    }

}
