<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterTahunAjaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('master_tahun_ajaran')->truncate();

        $seeds = DB::table('master_tahun_ajaran')->insert([
            [
                'kode'  => '1819GANJIL',
                'tahun' => '2018 - 2019',
                'semester' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
