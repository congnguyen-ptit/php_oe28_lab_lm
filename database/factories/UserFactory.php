<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'code' => Str::random(5),
        'name' => $faker->name,
        'user_slug' => Str::slug($faker->name),
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'username' => $faker->unique()->name,
        'password' => Str::random(6),
        'role_id' => random_int(1, 3),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
        'provider' => 1,
        'provider_id' => 1,
    ];
});
