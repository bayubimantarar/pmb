<?php

use Faker\Generator as Faker;

$factory->define(App\JenisUjian::class, function (Faker $faker) {
    return [
        'kode' => 'UAS',
        'nama' => 'Ujian Akhir Semester'
    ];
});
