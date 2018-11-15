<?php

namespace App\Repositories\PMB;

use App\Soal;
use App\TahunAjaran;
use App\JenisUjian;
use App\MataKuliah;
use App\Models\PMB\Hasil;

class HasilRepository
{
    public function checkHasilDataBySoal($kodeSoal)
    {
        $getHasil = Hasil::where('kode_soal', '=', $kodeSoal)
            ->get();

        return $getHasil;
    }

    public function getAllHasilData()
    {
        $getHasil = Hasil::All();
        
        return $getHasil;
    }

    public function getSingleHasilData($id)
    {
        $getHasil = Hasil::findOrFail($id);

        return $getHasil;
    }

    public function getSingleHasilDataForKeteranganLulus($id)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa_status', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_hasil.kode_pendaftaran')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.jurusan_pilihan')
            ->where('pmb_hasil.id', $id)
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataByCalonMahasiswa()
    {
        $getHasil = Hasil::join(
            'pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran'
        )
        ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama')
        ->get();
        
        return $getHasil;
    }

    public function getAllHasilDataByFilter(
        $kodeJurusan, 
        $kodeGelombang, 
        $kodeKelas,
        $tahun
    ) {
        $getHasil = Hasil::where('kode_jurusan', '=', $kodeJurusan)
            ->where('kode_gelombang', '=', $kodeGelombang)
            ->where('kode_kelas', '=', $kodeKelas)
            ->whereYear('created_at', $tahun)
            ->get();
        
        return $getHasil;
    }

    public function storeHasilData($data)
    {
        $storeHasil = Hasil::create($data);
        
        return $storeHasil;
    }

    public function updateHasilData($id, $data)
    {
        $updateHasil = Hasil::where('id', '=', $id)
            ->update($data);
        
        return $updateHasil;
    }    

    public function destroyHasilData($kodeSoal)
    {
        $destroyHasil = Hasil::where('kode_soal', '=', $kodeSoal)
            ->delete();

        return $destroyHasil;
    }
}
