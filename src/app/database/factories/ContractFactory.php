<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contract;
use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'valid_from' => $faker->dateTime,
        'valid_to' => $faker->dateTime,
        'vehicle_id' => factory(Vehicle::class)->create(),
        'usage' => $faker->randomElement(['firma', 'preprava osob']),
        'vehicle_value' => $faker->randomFloat(2, 100, 100000),
        'coverage' => $faker->randomFloat(2, 100, 100000),
        'annual_mileage' => $faker->randomFloat(2, 100, 100000),
    ];
});
