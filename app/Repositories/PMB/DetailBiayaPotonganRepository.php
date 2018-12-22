<?php

namespace App\Repositories\PMB;

use DB;
use App\Models\PMB\DetailBiayaPotongan;

class DetailBiayaPotonganRepository
{
    public function getAllData()
    {
        $getDetailBiayaPotongan = DetailBiayaPotongan::all();

        return $getDetailBiayaPotongan;
    }

    public function getAllDataForFormulir()
    {
        $getDetailBiayaPotongan = DetailBiayaPotongan::join('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->select('pmb_biaya.*', 'pmb_detail_biaya_potongan.deskripsi', 'pmb_detail_biaya_potongan.kode_biaya', 'pmb_detail_biaya_potongan.jumlah')
            ->groupBy('pmb_detail_biaya_potongan.deskripsi', 'pmb_detail_biaya_potongan.kode_biaya')
            ->orderBy('pmb_detail_biaya_potongan.kode_biaya')
            ->get();

        return $getDetailBiayaPotongan;
    }

    public function getAllDataForFormulirByDeskripsi()
    {
        $getDetailBiayaPotongan = DetailBiayaPotongan::join('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->select('pmb_detail_biaya_potongan.deskripsi', DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Pagi" THEN pmb_detail_biaya_potongan.jumlah END) as pagi'), DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Sore" THEN pmb_detail_biaya_potongan.jumlah END) as sore'), DB::RAW('MAX(CASE WHEN pmb_biaya.kelas="Kelas Eksekutif" THEN pmb_detail_biaya_potongan.jumlah END) as eksekutif'))
            ->groupBy('pmb_detail_biaya_potongan.deskripsi')
            ->get();

        return $getDetailBiayaPotongan;
    }

    public function getSingleDataForBiayaByDeskripsi($kodeKelas, $kodePotongan, $tempKodeGelombang)
    {
        $getDetailBiayaPotongan = DetailBiayaPotongan::leftJoin('pmb_biaya', 'pmb_detail_biaya_potongan.kode_biaya', '=', 'pmb_biaya.id')
            ->leftJoin('pmb_potongan', 'pmb_detail_biaya_potongan.kode_potongan', '=', 'pmb_potongan.id')
            ->leftJoin('pmb_gelombang', 'pmb_detail_biaya_potongan.kode_gelombang', '=', 'pmb_gelombang.id')
            ->select('pmb_detail_biaya_potongan.deskripsi', DB::RAW('MAX(CASE WHEN pmb_detail_biaya_potongan.kode_biaya='.$kodeKelas.' THEN pmb_detail_biaya_potongan.jumlah END) as biaya'), DB::RAW('MAX(CASE WHEN pmb_detail_biaya_potongan.kode_potongan='.$kodePotongan.' THEN pmb_detail_biaya_potongan.jumlah END) as potongan_jalur'), DB::RAW('MAX(CASE WHEN pmb_detail_biaya_potongan.kode_gelombang='.$tempKodeGelombang.' THEN pmb_detail_biaya_potongan.jumlah END) as potongan_gelombang'))
            ->groupBy('pmb_detail_biaya_potongan.deskripsi')
            ->get();

        return $getDetailBiayaPotongan;
    }

    public function getSingleData($id)
    {
        $getDetailBiayaPotonganData = DetailBiayaPotongan::findOrFail($id);

        return $getDetailBiayaPotonganData;
    }

    public function getSingleDataForDetailBiayaPotongan($kodeBiaya)
    {
        $getDetailBiayaPotonganData = DetailBiayaPotongan::where('kode_biaya', '=', $kodeBiaya)
            ->get();

        return $getDetailBiayaPotonganData;
    }

    public function getSingleDataForDetailBiayaPotonganForGelombang($kodeGelombang)
    {
        $getDetailBiayaPotonganData = DetailBiayaPotongan::where('kode_gelombang', '=', $kodeGelombang)
            ->get();

        return $getDetailBiayaPotonganData;
    }

    public function getSingleDataForDetailBiayaPotonganForPotongan($kodePotongan)
    {
        $getDetailBiayaPotonganData = DetailBiayaPotongan::where('kode_potongan', '=', $kodePotongan)
            ->get();

        return $getDetailBiayaPotonganData;
    }

    public function storeDetailBiayaPotonganData($data)
    {
        $storeDetailBiayaPotonganData = DetailBiayaPotongan::create($data);

        return $storeDetailBiayaPotonganData;
    }

    public function updateDetailBiayaPotonganData($data, $id)
    {
        $updateDetailBiayaPotonganData = DetailBiayaPotongan::where('id', $id)
            ->update($data);

        return $updateDetailBiayaPotonganData;
    }

    public function destroyDetailBiayaPotonganData($id)
    {
        $destroyDetailBiayaPotonganData = DetailBiayaPotongan::destroy($id);

        return $destroyDetailBiayaPotonganData;
    }

}
