<?php

use Faker\Generator as Faker;

$factory->define(\App\TahunAjaran::class, function (Faker $faker) {
    return [
        'kode'      => '1819GANJIL',
        'tahun'     => '2018 - 2019',   
        'semester'  => 'Ganjil'
    ];
});
