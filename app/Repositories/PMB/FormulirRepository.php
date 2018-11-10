<?php

namespace App\Repositories\PMB;

use App\Models\PMB\CalonMahasiswa;

class FormulirRepository
{
    public function getAllData()
    {
        $getFormulir = CalonMahasiswa::join(
            'pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran'
        )
        ->join('pmb_calon_mahasiswa_biodata_orang_tua_wali', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kode_pendaftaran')
        ->join('pmb_calon_mahasiswa_status', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_status.kode_pendaftaran')
        ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
        ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.nomor_telepon', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.jenis_kelamin', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.alamat', 'pmb_calon_mahasiswa_biodata.rt_rw', 'pmb_calon_mahasiswa_biodata.kelurahan', 'pmb_calon_mahasiswa_biodata.kecamatan', 'pmb_calon_mahasiswa_biodata.kode_pos', 'pmb_calon_mahasiswa_biodata.kota_kabupaten', 'pmb_calon_mahasiswa_biodata.provinsi', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_biodata.pekerjaan', 'pmb_calon_mahasiswa_biodata.nomor_telepon_rumah', 'pmb_calon_mahasiswa_biodata.nomor_telepon', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.website', 'pmb_calon_mahasiswa_biodata.mengenal_stmik', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.asal_jurusan', 'pmb_calon_mahasiswa_status.status', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nama_ayah', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nama_ibu', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.pekerjaan_ayah', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.pekerjaan_ibu', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.alamat AS alamat_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.rt_rw AS rt_rw_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kelurahan AS kelurahan_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kecamatan AS kecamatan_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kode_pos AS kode_pos_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kota_kabupaten AS kota_kabupaten_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.provinsi AS provinsi_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nomor_telepon_rumah AS nomor_telepon_rumah_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nomor_telepon AS nomor_telepon_orang_tua')
        ->get();
        
        return $getFormulir;
    }

    public function getSingleData($id)
    {
        $getFormulir = CalonMahasiswa::join(
            'pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran'
        )
        ->join('pmb_calon_mahasiswa_biodata_orang_tua_wali', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kode_pendaftaran')
        ->join('pmb_calon_mahasiswa_status', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_status.kode_pendaftaran')
        ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
        ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.nomor_telepon', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.jenis_kelamin', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.alamat', 'pmb_calon_mahasiswa_biodata.rt_rw', 'pmb_calon_mahasiswa_biodata.kelurahan', 'pmb_calon_mahasiswa_biodata.kecamatan', 'pmb_calon_mahasiswa_biodata.kode_pos', 'pmb_calon_mahasiswa_biodata.kota_kabupaten', 'pmb_calon_mahasiswa_biodata.provinsi', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_biodata.pekerjaan', 'pmb_calon_mahasiswa_biodata.nomor_telepon_rumah', 'pmb_calon_mahasiswa_biodata.nomor_telepon', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.website', 'pmb_calon_mahasiswa_biodata.mengenal_stmik', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.asal_jurusan', 'pmb_calon_mahasiswa_status.status', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nama_ayah', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nama_ibu', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.pekerjaan_ayah', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.pekerjaan_ibu', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.alamat AS alamat_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.rt_rw AS rt_rw_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kelurahan AS kelurahan_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kecamatan AS kecamatan_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kode_pos AS kode_pos_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.kota_kabupaten AS kota_kabupaten_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.provinsi AS provinsi_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nomor_telepon_rumah AS nomor_telepon_rumah_orang_tua', 'pmb_calon_mahasiswa_biodata_orang_tua_wali.nomor_telepon AS nomor_telepon_orang_tua')
        ->where('pmb_calon_mahasiswa.id', '=', $id)
        ->get();

        return $getFormulir;
    }

    public function storeFormulirData($data)
    {
        $storeFormulirData = CalonMahasiswa::create($data);
        
        return $storeFormulirData;
    }

    public function updateFormulirData($data, $id)
    {
        $updateFormulirData = CalonMahasiswa::where('id', $id)
            ->update($data);

        return $updateFormulirData;
    }

    public function destroyFormulirPMBData($id)
    {
        $destroyFormulirData = CalonMahasiswa::destroy($id);

        return $destroyFormulirData;
    }

}
