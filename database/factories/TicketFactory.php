<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use App\User;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {

    $date = $faker->dateTimeBetween('now', '+30 days');
    $number = sprintf('%07d', $faker->unique()->randomNumber(7));
    $date_string = $date->format('Ymd');
    $date_number = $faker->unique()->regexify("/^$date_string-$number/");
    $uniq_number = explode('-', $date_number)[1];
    $user_ids = range(0,1000);

    return [
        'number' => $uniq_number,
        'drawing_date' => $date->format('Y-m-d'),
        'user_id' => $faker->randomElement($user_ids), 
        // this works only for small amounts
        // 'user_id' => User::all()->random()->id,
    ];
});
