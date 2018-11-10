<?php

use Faker\Generator as Faker;

$factory->define(\App\Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => '1215001',
        'nama' => 'Acep Sodik',
        'jenis_kelamin' => '1',
        'alamat' => 'Soreang',
        'email' => 'sodik@mail.com',
        'password' => bcrypt('123'),
    ];
});
