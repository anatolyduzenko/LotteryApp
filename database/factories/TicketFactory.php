<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use App\User;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'number' => sprintf('%07d', $faker->unique()->randomNumber(7)),
        'drawing_date' => $faker->dateTimeBetween('now', '+30 days'),
        'user_id' => User::all()->random()->id,
    ];
});
