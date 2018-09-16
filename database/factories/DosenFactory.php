<?php

use Faker\Generator as Faker;

$factory->define(App\Dosen::class, function (Faker $faker) {
    return [
        'nip' => rand(10, 1000),
        'nama' => $faker->name,
        'jenis_kelamin' => rand(0, 1),
        'alamat' => $faker->address,
        'email' => $faker->unique()->freeEmail,
        'password' => bcrypt('123'),
    ];
});
