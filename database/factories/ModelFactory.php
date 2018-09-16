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

$factory->define(\App\Domain\Order\Models\Order::class,
    function (Faker\Generator $faker) {

    return [
        'origin' => "[$faker->latitude,$faker->longitude]",
        'destination' => "[$faker->latitude,$faker->longitude]"
    ];

});
