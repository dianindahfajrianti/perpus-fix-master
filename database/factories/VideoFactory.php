<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'desc' => $faker->paragraph(4),
        'filename' => $faker->slug(4).".mp4",
        'thumb' => $faker->slug(4).".png",
        'filetype' => 'mp4',
        'clicked_time' => rand(0,999),
        'edu_id' => rand(1,4),
        'grade_id' => rand(1,12),
        'major_id' => rand(1,11),
        'sub_id' => rand(1,5),
        'creator' => $faker->title().$faker->lastName().".  ".$faker->firstName(),
    ];
});
