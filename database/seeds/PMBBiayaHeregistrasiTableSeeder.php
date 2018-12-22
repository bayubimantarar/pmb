<?php


use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBBiayaHeregistrasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_biaya_heregistrasi')->truncate();

        $seed = DB::table('pmb_biaya_heregistrasi')->insert([
            [
                'jumlah' => 1000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
