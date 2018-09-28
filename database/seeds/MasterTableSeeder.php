<?php

use Illuminate\Database\Seeder;

class MasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosenTruncate          = DB::table('dosen')->truncate();
        $jenisujianTruncate     = DB::table('jenis_ujian')->truncate();
        $kelasTruncate          = DB::table('kelas')->truncate();
        $mahasiswaTruncate      = DB::table('mahasiswa')->truncate();
        $matakuliahTruncate     = DB::table('mata_kuliah')->truncate();
        $tahunajaranTruncate    = DB::table('tahun_ajaran')->truncate();
        $userTruncate           = DB::table('users')->truncate();

        $dosenFactory       = Factory(\App\Dosen::class)->create();
        $jenisujianFactory  = Factory(\App\JenisUjian::class)->create();
        $kelasFactory       = Factory(\App\Kelas::class)->create();
        $mahasiswaFactory   = Factory(\App\Mahasiswa::class)->create();
        $matakuliahFactory  = Factory(\App\MataKuliah::class)->create();
        $tahunajaranFactory = Factory(\App\TahunAjaran::class)->create();
        $userFactory        = Factory(\App\User::class)->create();
    }
}
