<?php

namespace App\Repositories\PMB;

use DB;
use App\Soal;
use App\TahunAjaran;
use App\JenisUjian;
use App\MataKuliah;
use App\Models\PMB\HasilUpdate;

class HasilUpdateRepository
{
    public function checkHasilUpdateDataBySoal($kodeSoal)
    {
        $getHasilUpdate = HasilUpdate::where('kode_soal', '=', $kodeSoal)
            ->get();

        return $getHasilUpdate;
    }

    public function getAllHasilUpdateDataForLaporan()
    {
        $getHasil = HasilUpdate::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil_update.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil_update.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil_update.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->get();

        return $getHasil;
    }

    public function getAllHasilUPdateDataForChart()
    {
        $getHasil = HasilUpdate::select(DB::raw("(SELECT COUNT(*) FROM pmb_hasil_update WHERE status='Lulus' AND kode_jurusan='IF') as if_lulus, (SELECT COUNT(*) FROM pmb_hasil_update WHERE status='Tidak Lulus' AND kode_jurusan='IF') as if_tidak_lulus, (SELECT COUNT(*) FROM pmb_hasil_update WHERE status='Lulus' AND kode_jurusan='SI') as si_lulus, (SELECT COUNT(*) FROM pmb_hasil_update WHERE status='Tidak Lulus' AND kode_jurusan='SI') as si_tidak_lulus"))
            ->get()
            ->first();

        return $getHasil;
    }

    public function getAllHasilUpdateData()
    {
        $getHasilUpdate = HasilUpdate::All();

        return $getHasilUpdate;
    }

    public function getSingleHasilUpdateData($id)
    {
        $getHasilUpdate = HasilUpdate::findOrFail($id);

        return $getHasilUpdate;
    }

    public function getSingleHasilUpdateDataForKeteranganLulus($id)
    {
        $getHasilUpdate = HasilUpdate::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->join('pmb_calon_mahasiswa_status', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_status.kode_pendaftaran')
            ->select('pmb_hasil_update.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.jurusan_pilihan', 'pmb_calon_mahasiswa.kode_kelas', 'pmb_calon_mahasiswa.kode_gelombang', 'pmb_calon_mahasiswa.kode_potongan', 'pmb_calon_mahasiswa.kode_jurusan')
            ->where('pmb_hasil_update.id', $id)
            ->get()
            ->first();

        return $getHasilUpdate;
    }

    public function getAllHasilUpdateDataByCalonMahasiswa()
    {
        $getHasilUpdate = HasilUpdate::join(
            'pmb_calon_mahasiswa_biodata', 'pmb_hasil_update.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran'
        )
        ->select('pmb_hasil_update.*', 'pmb_calon_mahasiswa_biodata.nama')
        ->get();

        return $getHasilUpdate;
    }

    public function getAllHasilUpdateDataByFilter(
        $kodeJurusan,
        $kodeGelombang,
        $kodeKelas,
        $tahun
    ) {
        $getHasilUpdate = HasilUpdate::where('kode_jurusan', '=', $kodeJurusan)
            ->where('kode_gelombang', '=', $kodeGelombang)
            ->where('kode_kelas', '=', $kodeKelas)
            ->whereYear('created_at', $tahun)
            ->get();

        return $getHasilUpdate;
    }

    public function storeHasilUpdateData($data)
    {
        $storeHasilUpdate = HasilUpdate::create($data);

        return $storeHasilUpdate;
    }

    public function updateHasilUpdateData($id, $data)
    {
        $updateHasilUpdate = HasilUpdate::where('id', '=', $id)
            ->update($data);

        return $updateHasilUpdate;
    }

    public function destroyHasilUpdateData($kodeSoal)
    {
        $destroyHasilUpdate = HasilUpdate::where('kode_soal', '=', $kodeSoal)
            ->delete();

        return $destroyHasilUpdate;
    }
}
