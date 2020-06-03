<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignVote;
use Faker\Generator as Faker;

$factory->define(DesignVote::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,10),
        'design_id' => $faker->numberBetween(1,10),

    ];
});
