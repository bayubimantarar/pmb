<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBGelombangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_gelombang')->truncate();

        $seeds = DB::table('pmb_gelombang')->insert([
            [
                'kode' => 'GELOMBANG1',
                'nama' => 'Gelombang 1',
                'dari_tanggal' => '2018-01-01',
                'sampai_tanggal' => '2018-04-30',
                'jumlah_potongan' => '1500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode' => 'GELOMBANG2',
                'nama' => 'Gelombang 2',
                'dari_tanggal' => '2018-05-01',
                'sampai_tanggal' => '2018-07-31',
                'jumlah_potongan' => '1000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode' => 'GELOMBANG3',
                'nama' => 'Gelombang 3',
                'dari_tanggal' => '2018-08-01',
                'sampai_tanggal' => '2018-12-31',
                'jumlah_potongan' => '500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
