<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PenggunaProdiTableSeeder::class);
        $this->call(PenggunaMasterTableSeeder::class);
        $this->call(PenggunaPanitiaTableSeeder::class);
        $this->call(PenggunaKeuanganTableSeeder::class);
        $this->call(PMBBiayaTableSeeder::class);
        $this->call(PMBPotonganTableSeeder::class);
        $this->call(PMBGelombangTableSeeder::class);
        $this->call(PMBDetailBiayaPotonganTableSeeder::class);
        $this->call(MasterProdiTableSeeder::class);
        $this->call(MasterTahunAjaranTableSeeder::class);
        $this->call(NilaiLulusTableSeeder::class);
    }
}
