<?php

namespace App\Repositories\PMB;

use App\Models\PMB\KonfirmasiPembayaran;

class KonfirmasiPembayaranRepository
{
    public function getAllData()
    {
        $getKonfirmasiPembayaran = KonfirmasiPembayaran::All();
        
        return $getKonfirmasiPembayaran;
    }

    public function getSingleData($id)
    {
        $getKonfirmasiPembayaranData = KonfirmasiPembayaran::findOrFail($id);

        return $getKonfirmasiPembayaranData;
    }

    public function storeKonfirmasiPembayaranData($data)
    {
        $storeKonfirmasiPembayaranData = KonfirmasiPembayaran::create($data);
        
        return $storeKonfirmasiPembayaranData;
    }

    public function updateKonfirmasiPembayaranData($data, $id)
    {
        $updateKonfirmasiPembayaranData = KonfirmasiPembayaran::where('id', $id)
            ->update($data);

        return $updateKonfirmasiPembayaranData;
    }

    public function destroyKonfirmasiPembayaranData($id)
    {
        $destroyKonfirmasiPembayaranData = KonfirmasiPembayaran::destroy($id);

        return $destroyKonfirmasiPembayaranData;
    }
}
