<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenggunaMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pengguna_master')->truncate();

        $seeds = DB::table('pengguna_master')->insert([
            [
                'nama'  => 'Administrator PMB',
                'email' => 'adminpmb@stmik-bandung.ac.id',
                'nomor_telepon' => '087822988481',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama'  => 'Bayu Bimantara',
                'email' => 'bayubimantarar@gmail.com',
                'nomor_telepon' => '0895332055486',
                'alamat' => 'Bandung',
                'password' => '$2y$12$ORxB/xMNz9vEb80rRwHkZOX85jgxkK3SLfHuulhAXVHgbLLbY8zMS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
