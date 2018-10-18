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
    }
}
