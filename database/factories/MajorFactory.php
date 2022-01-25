<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $jur = [
        'Umum','Bahasa','IPA','IPS','Komputer Jaringan','Tata Boga','Kendaraan Ringan','Otomotif','Perhotelan','Tata Rias'
    ];
    return [
        'major_name' => shuffle($jur)
    ];
});
