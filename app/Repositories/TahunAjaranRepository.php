<?php

namespace App\Repositories;

use App\TahunAjaran;

class TahunAjaranRepository
{
    public function getAllData()
    {
        $getDosen = TahunAjaran::orderBy('created_at', 'DESC')
            ->get();
        
        return $getDosen;
    }

    public function getSingleData($id)
    {
        $getTahunAjaran = TahunAjaran::findOrFail($id);

        return $getTahunAjaran;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getDosen = Post::where('slug', '=', $slug)
            ->firstOrFail();
        return $getDosen;
    }

    public function storeTahunAjaranData($data)
    {
        $storeTahunAjaran = TahunAjaran::create($data);
        
        return $storeTahunAjaran;
    }

    public function updateTahunAjaranData($data, $id)
    {
        $updateTahunAjaran = TahunAjaran::where('id', $id)
            ->update($data);

        return $updateTahunAjaran;
    }

    public function destroyTahunAjaranData($id)
    {
        $destroyTahunAjaran = TahunAjaran::destroy($id);

        return $destroyTahunAjaran;
    }

}
