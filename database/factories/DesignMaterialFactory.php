<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DesignMaterial;
use Faker\Generator as Faker;

$factory->define(DesignMaterial::class, function (Faker $faker) {
    return [
        //
        'design_id' => $faker->numberBetween(1,10),
        'material_id' => $faker->numberBetween(1,10),
    ];
});
