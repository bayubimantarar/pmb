<?php

namespace App\Repositories\PMB;

use DB;
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

    public function getAllHasilDataForLaporan()
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForChart()
    {
        $getHasil = Hasil::select(DB::raw("(SELECT COUNT(*) FROM pmb_hasil WHERE status='Lulus' AND kode_jurusan='IF') as if_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Tidak Lulus' AND kode_jurusan='IF') as if_tidak_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Lulus' AND kode_jurusan='SI') as si_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Tidak Lulus' AND kode_jurusan='SI') as si_tidak_lulus"))
            ->get()
            ->first();

        return $getHasil;
    }

    public function getAllHasilDataForChartByTahun($tahun)
    {
        $getHasil = Hasil::select(DB::raw("(SELECT COUNT(*) FROM pmb_hasil WHERE status='Lulus' AND kode_jurusan='IF') as if_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Tidak Lulus' AND kode_jurusan='IF') as if_tidak_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Lulus' AND kode_jurusan='SI') as si_lulus, (SELECT COUNT(*) FROM pmb_hasil WHERE status='Tidak Lulus' AND kode_jurusan='SI') as si_tidak_lulus"))
            ->whereYear('pmb_hasil.created_at', '=', $tahun)
            ->get();

        return $getHasil;
    }

    // public function getAllHasilDataForLaporanFilter($jurusan, $tahun,)
    // {
    //     $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
    //         ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
    //         ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
    //         ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
    //         ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
    //         ->get();

    //     return $getHasil;
    // }

    public function getAllHasilDataForLaporanByJurusan($jurusan, $tahun)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->when($jurusan != "NULL", function ($query) use($jurusan){
                return $query->where('pmb_hasil.kode_jurusan', '=', $jurusan);
            })
            ->when($tahun != "NULL", function ($query) use($tahun){
                return $query->whereYear('pmb_hasil.created_at', '=', $tahun);
            })
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForLaporanByTahun($tahun)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->whereYear('pmb_hasil.created_at', '=', $tahun)
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForLaporanBySesi($sesi)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->where('pmb_hasil.kode_jadwal_ujian', '=', $sesi)
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForLaporanByPendaftaran($pendaftaran)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->where('pmb_calon_mahasiswa.status_pendaftaran', '=', $pendaftaran)
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForLaporanByStatus($status)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->where('pmb_hasil.status', '=', $status)
            ->get();

        return $getHasil;
    }

    public function getAllHasilDataForLaporanByTanggal($tanggal)
    {
        $getHasil = Hasil::join('pmb_calon_mahasiswa_biodata', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('master_prodi', 'pmb_hasil.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_sesi', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_sesi.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa', 'pmb_hasil.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->select('pmb_hasil.*', 'pmb_calon_mahasiswa_biodata.nama', 'master_prodi.nama AS jurusan', DB::RAW('YEAR(pmb_hasil.created_at) AS tahun', ''), 'pmb_sesi.kode_jadwal_ujian AS sesi', 'pmb_calon_mahasiswa.status_pendaftaran')
            ->whereDate('pmb_hasil.created_at', '=', $tanggal)
            ->get();

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
