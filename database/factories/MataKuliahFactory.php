<?php

use Faker\Generator as Faker;

$factory->define(\App\MataKuliah::class, function (Faker $faker) {
    return [
        'kode' => 'IF0001',
        'nama' => 'Pemograman 1 (C/C++)'
    ];
});
