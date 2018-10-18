<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenggunaPanitiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pengguna_panitia')->truncate();

        $seeds = DB::table('pengguna_panitia')->insert([
            [
                'nidn' => '0403027304',
                'nama'  => 'Uro Abdulrohim, MT',
                'email' => 'uroabdulrohim@gmail.com',
                'nomor_telepon' => '087822988483',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nidn' => '0410087711',
                'nama'  => 'Yus Jayusman, MT',
                'email' => 'yusjayusman@gmail.com',
                'nomor_telepon' => '08156037494',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nidn' => '0020087901',
                'nama'  => 'Rini Nurarini Sukmana, MT',
                'email' => 'rininurarni@gmail.com',
                'nomor_telepon' => '08882024236',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nidn' => '10241184001',
                'nama'  => 'Indra Maulana Yusup Kusumah, M.Kom',
                'email' => 'indramaulanayusupkusumah@gmail.com',
                'nomor_telepon' => '085659021234',
                'alamat' => 'Bandung',
                'password' => bcrypt('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nidn' => '0826098201',
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
