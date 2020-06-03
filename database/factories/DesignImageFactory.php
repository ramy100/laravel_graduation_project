<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignImage;
use Faker\Generator as Faker;

$factory->define(DesignImage::class, function (Faker $faker) {
    return [
        //
        'image' => 'uploads/'.Str::random(10),
        'design_id' => $faker->numberBetween(1,10),

    ];
});
