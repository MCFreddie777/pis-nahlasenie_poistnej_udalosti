<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\sk_SK\Person($faker));

    return [

        'title_before' => rand(0, 1) ? $faker->title : NULL,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title_after' => rand(0, 1) ? $faker->suffix : NULL,
        'national_identity_number' => $faker->unique()->regexify('[0-9]{6}/[0-9]{4}'),
        'address' => $faker->address,
        'tel' => rand(0, 1) ? $faker->unique()->phoneNumber : NULL,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'role_id' => $faker->randomElement([2, 3]), // employee || user
    ];
});
