<?php

namespace App\Repositories\PMB;

use DB;
use App\Models\PMB\DetailBiaya;

class DetailBiayaRepository
{
    public function getAllData()
    {
        $getDetailBiaya = DetailBiaya::all();

        return $getDetailBiaya;
    }

    public function getAllDataForFormulir()
    {
        $getDetailBiaya = DetailBiaya::join('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->select('pmb_biaya.*', 'pmb_detail_biaya_potongan.deskripsi', 'pmb_detail_biaya_potongan.kode_biaya', 'pmb_detail_biaya_potongan.jumlah')
            ->groupBy('pmb_detail_biaya_potongan.deskripsi', 'pmb_detail_biaya_potongan.kode_biaya')
            ->orderBy('pmb_detail_biaya_potongan.kode_biaya')
            ->get();

        return $getDetailBiaya;
    }

    public function getAllDataForFormulirByDeskripsi()
    {
        $getDetailBiaya = DetailBiaya::join('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->select('pmb_detail_biaya_potongan.deskripsi', DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Pagi" THEN pmb_detail_biaya_potongan.jumlah END) as pagi'), DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Sore" THEN pmb_detail_biaya_potongan.jumlah END) as sore'), DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Eksekutif" THEN pmb_detail_biaya_potongan.jumlah END) as eksekutif'))
            ->groupBy('pmb_detail_biaya_potongan.deskripsi')
            ->get();

        return $getDetailBiaya;
    }

    public function getSingleDataForBiayaByDeskripsi($kodeKelas, $kodePotongan)
    {
        $getDetailBiaya = DetailBiaya::leftJoin('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->leftJoin('pmb_potongan', 'pmb_detail_biaya_potongan.kode_potongan', '=', 'pmb_potongan.id')
            ->select('pmb_detail_biaya_potongan.deskripsi', DB::RAW('MAX(CASE WHEN pmb_detail_biaya_potongan.kode_biaya='.$kodeKelas.' THEN pmb_detail_biaya_potongan.jumlah END) as biaya'), DB::RAW('MAX(CASE WHEN pmb_detail_biaya_potongan.kode_potongan='.$kodePotongan.' THEN pmb_detail_biaya_potongan.jumlah END) as potongan'))
            ->groupBy('pmb_detail_biaya_potongan.deskripsi')
            ->get();

        return $getDetailBiaya;
    }

    public function getSingleData($id)
    {
        $getDetailBiayaData = DetailBiaya::findOrFail($id);

        return $getDetailBiayaData;
    }

    public function getSingleDataForDetailBiaya($kodeBiaya)
    {
        $getDetailBiayaData = DetailBiaya::where('kode_biaya', '=', $kodeBiaya)
            ->get();

        return $getDetailBiayaData;
    }

    public function storeDetailBiayaData($data)
    {
        $storeDetailBiayaData = DetailBiaya::create($data);

        return $storeDetailBiayaData;
    }

    public function updateDetailBiayaData($data, $id)
    {
        $updateDetailBiayaData = DetailBiaya::where('id', $id)
            ->update($data);

        return $updateDetailBiayaData;
    }

    public function destroyDetailBiayaData($id)
    {
        $destroyDetailBiayaData = DetailBiaya::destroy($id);

        return $destroyDetailBiayaData;
    }

}
