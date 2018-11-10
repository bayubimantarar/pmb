<?php

namespace App\Repositories;

use App\JenisUjian;

class JenisUjianRepository
{
    public function getAllData()
    {
        $getJenisUjian = jenisUjian::orderBy('created_at', 'DESC')
            ->get();
        
        return $getJenisUjian;
    }

    public function getAllDataWithPagination()
    {
        $getJenisUjian = jenisUjian::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getJenisUjian;
    }

    public function getSingleData($id)
    {
        $getJenisUjian = jenisUjian::where('id', '=', $id)
            ->firstOrFail();

        return $getJenisUjian;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getJenisUjian = jenisUjian::where('slug', '=', $slug)
            ->firstOrFail();

        return $getJenisUjian;
    }

    public function storeJenisUjianData($data)
    {
        $storeJenisUjian = jenisUjian::create($data);
        
        return $storeJenisUjian;
    }

    public function updateJenisUjianData($data, $id)
    {
        $updateJenisUjian = jenisUjian::where('id', $id)
            ->update($data);

        return $updateJenisUjian;
    }

    public function destroyJenisUjianData($id)
    {
        $destroyJenisUjian = jenisUjian::destroy($id);

        return $destroyJenisUjian;
    }

}
