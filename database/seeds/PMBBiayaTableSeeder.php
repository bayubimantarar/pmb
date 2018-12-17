<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBBiayaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_biaya')->truncate();

        $seed = DB::table('pmb_biaya')->insert([
            [
                'kelas' => 'Kelas Pagi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kelas' => 'Kelas Sore',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kelas' => 'Kelas Eksekutif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
