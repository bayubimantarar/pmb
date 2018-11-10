<?php

use Faker\Generator as Faker;

$factory->define(\App\Dosen::class, function (Faker $faker) {
    return [
        'nip' => '19752005001',
        'nama' => 'John Wick S.Kom.',
        'jenis_kelamin' => '1',
        'alamat' => 'Bandung',
        'email' => 'johnwick@mail.com',
        'password' => bcrypt('123'),
    ];
});
