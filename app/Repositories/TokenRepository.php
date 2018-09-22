<?php

namespace App\Repositories;

use App\Token;

class TokenRepository
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

    public function getSingleDataForSoal($token)
    {
        $getToken = Token::where('token', '=', $token)
            ->firstOrFail();
            
        return $getToken;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getMataKuliah = MataKuliah::where('slug', '=', $slug)
            ->firstOrFail();

        return $getMataKuliah;
    }

    public function storeTokenData($data)
    {
        $storeTokenData = Token::create($data);
        
        return $storeTokenData;
    }

    public function updateMataKuliahData($data, $id)
    {
        $updateMataKuliah = MataKuliah::where('id', $id)
            ->update($data);

        return $updateMataKuliah;
    }

    public function updateOnlyStatus($data, $token)
    {
        $updateMataKuliah = Token::where('token', $token)
            ->update($data);

        return $updateMataKuliah;
    }

    public function destroyTokenData($token)
    {
        $destroyToken = Token::where('token', '=', $token)
            ->delete();

        return $destroyToken;
    }

}
