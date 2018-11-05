<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('master_prodi')->truncate();

        $seeds = DB::table('master_prodi')->insert([
            [
                'kode'  => 'IF',
                'nama' => 'Teknik Informatika',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode'  => 'SI',
                'nama' => 'Sisem Informasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
