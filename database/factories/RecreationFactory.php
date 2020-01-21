<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recreation;
use Faker\Generator as Faker;

$factory->define(Recreation::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'address' => $faker->address,
        'location_id' => App\Location::all()->random()->id,
        'category_id' => App\Category::all()->random()->id,
        'active' => $faker->boolean(40),
        'opening_hour' => '08:00',
        'closing_hour' => '21:00',
    ];
});
