<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignImage;
use Faker\Generator as Faker;

$factory->define(DesignImage::class, function (Faker $faker) {
    return [
        //
        'image' => 'uploads/'.$faker->name,
        'design_id' => $faker->numberBetween(1,10),

    ];
});
