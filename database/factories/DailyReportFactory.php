<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    $testUserIds = [1, 2, 3, 4];
    return [
        'user_id' => $testUserIds[array_rand($testUserIds, 1)],
        'title' => $faker->word,
        'contents' => $faker->text(255),
        'reporting_time' => $faker->date('Y-m-d', 'now'),
    ];
});
