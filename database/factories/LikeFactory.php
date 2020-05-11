<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
	return [
		'user_id' => random_int(1, 50),
		'image_id' => random_int(1, 50),
	];
});
