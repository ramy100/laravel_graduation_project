<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignComment;
use Faker\Generator as Faker;

$factory->define(DesignComment::class, function (Faker $faker) {
    return [
        //
        'body' => $faker->text,
        'design_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
    ];
});
