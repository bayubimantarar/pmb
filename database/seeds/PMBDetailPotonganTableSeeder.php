<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBDetailPotonganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_detail_potongan')->truncate();

        $seed = DB::table('pmb_detail_potongan')->insert([
            [
                'kode_potongan' => '1',
                'deskripsi' => 'Biaya pendaftaran',
                'jumlah' => '250000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_potongan' => '2',
                'deskripsi' => 'Biaya jaket dan kemeja',
                'jumlah' => '350000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
