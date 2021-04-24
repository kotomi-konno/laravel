<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Goal;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        'users_id' => $faker->numberBetween(1,6),
        // 'name' => $faker->name,
        'content' => $faker->word."を達成する",
        'deadline' => $faker->date,
        'time' => $faker->time,
        'completed' => $faker->boolean,
    ];
});

