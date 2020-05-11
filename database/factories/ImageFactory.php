<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
	return [
		'user_id' => random_int(1, 50),
		'image_path' => $faker->text,
		'description' => $faker->text
	];
});
