<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\file_metadata;
use Faker\Generator as Faker;

$factory->define(file_metadata::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->description,,
        'path' => '/test/files.mp4'
    ];
});
