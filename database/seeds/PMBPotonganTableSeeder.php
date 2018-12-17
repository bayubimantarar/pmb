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
                'nama' => 'Jalur Undangan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Jalur Gaza',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
