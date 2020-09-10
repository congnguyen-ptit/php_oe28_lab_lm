<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Publisher;
use Faker\Generator as Faker;

$factory->define(Publisher::class, function (Faker $faker) {
    return [
        'code' => Str::random(5),
        'name' => $faker->name,
        'location' => $faker->address,
        'slug' => Str::slug($faker->name),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
