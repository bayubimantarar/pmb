<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenggunaProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pengguna_prodi')->truncate();

        $seeds = DB::table('pengguna_prodi')->insert([
            [
                'nidn' => '0826098201',
                'kode_prodi' => 'IF',
                'nama'  => 'Mina Ismu Rahayu, MT',
                'email' => 'ismurahayu@gmail.com',
                'nomor_telepon' => '081321131982',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nidn' => '1017078801',
                'kode_prodi' => 'SI',
                'nama'  => 'Siti Yuliyanti, M.Kom',
                'email' => 'sitiyuliyanti@gmail.com',
                'nomor_telepon' => '081785879875',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
