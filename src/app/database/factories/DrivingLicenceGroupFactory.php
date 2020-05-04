<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DrivingLicenceGroup;
use Faker\Generator as Faker;

$factory->define(DrivingLicenceGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['A', 'AM', 'A1', 'A2', 'B', 'BE', 'C', 'D', 'E', 'T'])
    ];
});
