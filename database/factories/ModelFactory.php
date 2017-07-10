<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'area_id' => 1,
        'npa' => rand(1000,3000),
        'adresse' => $faker->address,
        'city' => $faker->city,
        'phone' => "079 650 95 14",
        'api_token' => str_random(60),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('asdfasdf'),
        'remember_token' => str_random(10),
    ];
});
