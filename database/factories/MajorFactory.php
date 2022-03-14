<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Major;
use Faker\Generator as Faker;

$factory->define(Major::class, function (Faker $faker) {
    $jur = ['Umum','Bahasa','IPA','IPS','Komputer Jaringan','Tata Boga','Kendaraan Ringan','Otomotif','Perhotelan','Tata Rias', 'Elektro'];
    return [
        'maj_name' => shuffle($jur)
    ];
});
