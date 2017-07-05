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

use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 'user',
        'active' => true,
        'person_id' => rand(1,3),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Person::class, function (Generator $faker){
    return [
        'cedula' => rand(8232120,18289785),
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'phone_home' => $faker->phoneNumber,
        'address' => $faker->address,
        'role'  => 'parent'
    ];
});

$factory->define(App\Student::class, function (Generator $faker) {
    return [
        'person_id' => rand(6,10),
        'representant_id' => rand(1,5),
        'curse_id' => rand(1,12),
    ];
});

$factory->define(App\Representant::class, function (Generator $faker) {
    return [
        'person_id' => rand(1,5),
        'proffession_id' => rand(1,5)
    ];
});