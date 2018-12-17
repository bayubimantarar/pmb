<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PMBDetailBiayaPotonganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('pmb_detail_biaya_potongan')->truncate();

        $seed = DB::table('pmb_detail_biaya_potongan')->insert([
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pendaftaran',
                'jumlah' => '250000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya jaket dan kemeja',
                'jumlah' => '350000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya PSPT',
                'jumlah' => '500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pengembangan institusi',
                'jumlah' => '5000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kuliah',
                'jumlah' => '2850000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '1',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kemahasiswaan',
                'jumlah' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pendaftaran',
                'jumlah' => '250000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya jaket dan kemeja',
                'jumlah' => '350000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya PSPT',
                'jumlah' => '500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pengembangan institusi',
                'jumlah' => '5000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kuliah',
                'jumlah' => '3200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '2',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kemahasiswaan',
                'jumlah' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pendaftaran',
                'jumlah' => '250000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya jaket dan kemeja',
                'jumlah' => '350000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya PSPT',
                'jumlah' => '500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya pengembangan institusi',
                'jumlah' => '5000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kuliah',
                'jumlah' => '3850000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_biaya' => '3',
                'kode_potongan' => NULL,
                'deskripsi' => 'Biaya kemahasiswaan',
                'jumlah' => '300000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
