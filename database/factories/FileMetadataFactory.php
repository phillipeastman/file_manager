<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\file_metadata;
use Faker\Generator as Faker;

$factory->define(file_metadata::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->description,
        'original_filename' => 'JambaJuice.jpg',
        'file_type' => 'jpg',
        'tags' => $faker->tags,
        'path' => 'http://filemanager-api.test/file.jpg'
    ];
});
