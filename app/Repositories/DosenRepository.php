<?php

namespace App\Repositories;

use App\Dosen;

class DosenRepository
{
    public function getAllData()
    {
        $getDosen = Dosen::orderBy('created_at', 'DESC')
            ->get();
        
        return $getDosen;
    }

    public function getAllDataWithPagination()
    {
        $getDosen = Post::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getDosen;
    }

    public function getSingleData($id)
    {
        $getDosen = Dosen::where('id', '=', $id)
            ->firstOrFail();

        return $getDosen;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getDosen = Post::where('slug', '=', $slug)
            ->firstOrFail();
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
