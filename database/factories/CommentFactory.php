<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
	return [
		'user_id' => random_int(1, 50),
		'image_id' => random_int(1, 50),
		'content' => $faker->text
	];
});
