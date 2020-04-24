<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));

    return [
        'manufacturer' => $faker->vehicleBrand,
        'model' => $faker->vehicleModel,
        'body' => $faker->vehicleType,
        'color' => $faker->colorName,
        'fuel' => $faker->vehicleFuelType,
        'type' => $faker->vehicleType,
        'passenger_quantity' => $faker->vehicleSeatCount,
        'weight_class' => $faker->randomElement(['do 3.5t', 'osobny', 'dodavka', 'tahac']),
        'year' => $faker->biasedNumberBetween(1986, 2017, 'sqrt'),
        'engine_displacement' => $faker->randomNumber(4),
        'horsepower' => $faker->regexify('[0-9]{2,3}'),
        'weight_rating' => $faker->regexify('[0-9]{3,4}'),
    ];
});
