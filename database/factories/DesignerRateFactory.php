<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignerRate;
use Faker\Generator as Faker;

$factory->define(DesignerRate::class, function (Faker $faker) {
    return [
        //
        'rate' => $faker->numberBetween(1,9),
        'designer_id' => $faker->numberBetween(1,10),
        'liker_id' => $faker->numberBetween(1,10),
    ];
});
