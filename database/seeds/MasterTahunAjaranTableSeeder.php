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
                'tahun' => '2018',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
