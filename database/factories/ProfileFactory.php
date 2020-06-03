<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        //

        'user_id' => $faker->numberBetween(1,10),
        'website' => Str::random(10),
        'about' => Str::random(10),

    ];
});
