<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use App\DrivingLicence;
use App\DrivingLicenceGroup;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'national_identity_number' => $faker->unique()->regexify('[0-9]{6}/[0-9]{4}'),
        'address' => $faker->address,
        'licence_id' => factory(DrivingLicence::class)->create(),
    ];
});
