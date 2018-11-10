<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Gelombang;

class GelombangRepository
{
    public function getAllData()
    {
        $getGelombang = Gelombang::All();
        
        return $getGelombang;
    }

    public function getSingleData($id)
    {
        $getGelombangData = Gelombang::findOrFail($id);

        return $getGelombangData;
    }

    public function storeGelombangData($data)
    {
        $storeGelombangData = Gelombang::create($data);
        
        return $storeGelombangData;
    }

    public function updateGelombangData($data, $id)
    {
        $updateGelombangData = Gelombang::where('id', $id)
            ->update($data);

        return $updateGelombangData;
    }

    public function destroyGelombangData($id)
    {
        $destroyGelombangData = Gelombang::destroy($id);

        return $destroyGelombangData;
    }

}
