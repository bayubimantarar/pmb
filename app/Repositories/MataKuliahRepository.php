<?php

namespace App\Repositories;

use App\MataKuliah;

class MataKuliahRepository
{
    public function getAllData()
    {
        $getMataKuliah = MataKuliah::orderBy('created_at', 'DESC')
            ->get();
        
        return $getMataKuliah;
    }

    public function getAllDataWithPagination()
    {
        $getMataKuliah = MataKuliah::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getMataKuliah;
    }

    public function getSingleData($id)
    {
        $getMataKuliah = MataKuliah::where('id', '=', $id)
            ->firstOrFail();

        return $getMataKuliah;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getMataKuliah = MataKuliah::where('slug', '=', $slug)
            ->firstOrFail();

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
