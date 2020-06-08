<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;
$factory->define(Profile::class, function (Faker $faker) {
    static $number = 1;
    return [
        //
        'user_id' => $number++,
        'website' => $faker->domainName,
        'about' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
