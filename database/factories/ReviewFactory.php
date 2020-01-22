<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'recreation_id' => App\Recreation::all()->random()->id,
        'rating' => $faker->numberBetween(1,5),
        'comment' => $faker->sentences(1,5),
    ];
});
