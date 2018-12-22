<?php

namespace App\Repositories\PMB;

use App\Models\PMB\BiayaHeregistrasi;

class BiayaHeregistrasiRepository
{
    public function getAllData()
    {
        $getBiayaHeregistrasi = BiayaHeregistrasi::all();

        return $getBiayaHeregistrasi;
    }

    public function getSingleData($id)
    {
        $getBiayaHeregistrasiData = BiayaHeregistrasi::findOrFail($id);

        return $getBiayaHeregistrasiData;
    }

    public function getSingleDataForBiayaHeregistrasi($kodeKelas)
    {
        $getBiayaHeregistrasiData = BiayaHeregistrasi::where('id', '=', $kodeKelas)
            ->get()
            ->first();

        return $getBiayaHeregistrasiData;
    }

    public function storeBiayaHeregistrasiData($data)
    {
        $storeBiayaHeregistrasiData = BiayaHeregistrasi::create($data);

        return $storeBiayaHeregistrasiData;
    }

    public function updateBiayaHeregistrasiData($data, $id)
    {
        $updateBiayaHeregistrasiData = BiayaHeregistrasi::where('id', $id)
            ->update($data);

        return $updateBiayaHeregistrasiData;
    }

    public function destroyBiayaHeregistrasiData($id)
    {
        $destroyBiayaHeregistrasiData = BiayaHeregistrasi::destroy($id);

        return $destroyBiayaHeregistrasiData;
    }

}
