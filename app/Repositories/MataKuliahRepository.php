<?php

namespace App\Repositories;

use App\MataKuliah;

class MataKuliahRepository
{
    public function getAllData()
    {
        $getMataKuliah = MataKuliah::All();
        
        return $getMataKuliah;
    }

    public function getSingleData($id)
    {
        $getMataKuliah = MataKuliah::findOrFail($id);

        return $getMataKuliah;
    }

    public function storeMataKuliahData($data)
    {
        $storeMataKuliah = MataKuliah::create($data);
        
        return $storeMataKuliah;
    }

    public function updateMataKuliahData($data, $id)
    {
        $updateMataKuliah = MataKuliah::where('id', $id)
            ->update($data);

        return $updateMataKuliah;
    }

    public function destroyMataKuliahData($id)
    {
        $destroyMataKuliah = MataKuliah::destroy($id);

        return $destroyMataKuliah;
    }

}
