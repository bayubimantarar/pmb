<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncate = DB::table('users')
            ->truncate();

        $runFactory = Factory(App\User::class, 1)
            ->create();
    }
}
