<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use App\InsuranceEvent;
use Faker\Generator as Faker;

$factory->define(InsuranceEvent::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeThisYear(),
        'place' => $faker->address,
        'cost' => $faker->randomFloat(2),
        'last_event_id' => NULL,
        'note' => $faker->text,
        'review_note' => NULL,
        'driverA_id' => factory(Driver::class)->create(),
        'driverB_id' => factory(Driver::class)->create(),
    ];
});
