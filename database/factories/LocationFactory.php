<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'apartment_number' => random_int(1, 100),
        'street' => $faker->streetName,
        'ward' => $faker->state,
        'district' => $faker->cityPrefix,
        'city' => $faker->city,
        'user_id' => random_int(1, 10),
    ];
});
