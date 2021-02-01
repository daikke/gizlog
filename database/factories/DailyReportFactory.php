<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'title' => $faker->word,
        'contents' => $faker->text(255),
        'reporting_time' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
