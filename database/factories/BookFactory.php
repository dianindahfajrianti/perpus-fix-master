<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'desc' => $faker->paragraph(4),
        'filename' => $faker->slug(4).".pdf",
        'thumb' => $faker->slug(4).".png",
        'filetype' => 'pdf',
        'clicked_time' => rand(0,999),
        'edu_id' => rand(1,4),
        'grade_id' => rand(1,12),
        'major_id' => rand(1,11),
        'sub_id' => rand(1,5),
        'published_year' => rand(1930,2022),
        'publisher' => $faker->company(),
        'author' => $faker->title().$faker->lastName().".  ".$faker->firstName(),
    ];
});
