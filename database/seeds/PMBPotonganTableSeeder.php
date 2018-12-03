<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBPotonganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_potongan')->truncate();

        $seed = DB::table('pmb_potongan')->insert([
            [
                'deskripsi' => 'Jalur Undangan',
                'jumlah_potongan' => '150000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deskripsi' => 'Jalur Gaza',
                'jumlah_potongan' => '100000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
