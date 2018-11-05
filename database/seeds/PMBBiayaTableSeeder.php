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
                'biaya_pendaftaran' => '250000',
                'biaya_jaket_kemeja' => '350000',
                'biaya_pspt' => '500000',
                'biaya_pengembangan_institusi' => '5000000',
                'biaya_kuliah' => '2850000',
                'biaya_kemahasiswaan' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kelas' => 'Kelas Sore',
                'biaya_pendaftaran' => '250000',
                'biaya_jaket_kemeja' => '350000',
                'biaya_pspt' => '500000',
                'biaya_pengembangan_institusi' => '5000000',
                'biaya_kuliah' => '3200000',
                'biaya_kemahasiswaan' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kelas' => 'Kelas Eksekutif',
                'biaya_pendaftaran' => '250000',
                'biaya_jaket_kemeja' => '350000',
                'biaya_pspt' => '500000',
                'biaya_pengembangan_institusi' => '5000000',
                'biaya_kuliah' => '3850000',
                'biaya_kemahasiswaan' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
