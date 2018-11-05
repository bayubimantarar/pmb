<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NilaiLulusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_nilai_lulus')->truncate();

        $seeds = DB::table('pmb_nilai_lulus')->insert([
            [
                'nilai' => '65',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
