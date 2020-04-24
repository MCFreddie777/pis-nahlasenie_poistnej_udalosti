<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DrivingLicence;
use Faker\Generator as Faker;

$factory->define(DrivingLicence::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\sk_SK\Address($faker));

    return [
        'licence_id' => $faker->unique()->regexify('[A-Z]{2}[0-9]{6}'),
        'valid_from' => $faker->dateTimeThisDecade,
        'valid_to' => $faker->dateTime('now'),
        'issued_by' => $faker->cityName,
    ];
});

$factory->afterCreating(DrivingLicence::class, function ($licence) {
    $licence->groups()
        ->sync(
            array_map(
                function ($key) {
                    return $key + 1;
                },
                array_rand(array_keys(
                    DrivingLicenceGroupsSeeder::$groups),
                    3
                ))
        );
});
