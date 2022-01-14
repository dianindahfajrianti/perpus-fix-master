<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'parent_id' => rand(1,4),
        'grade_name' => rand(1,12)
    ];
});
