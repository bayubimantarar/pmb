<?php

use Faker\Generator as Faker;

$factory->define(\App\Kelas::class, function (Faker $faker) {
    return [
        'kode' => 'REGPG',
        'nama' => 'Reguler Pagi'
    ];
});
