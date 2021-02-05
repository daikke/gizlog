<?php

use Faker\Generator as Faker;
use App\Models\User;
const TEST_USER_IDS = [1, 2, 3, 4];

$factory->define(App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => TEST_USER_IDS[array_rand(TEST_USER_IDS, 1)],
        'title' => $faker->word,
        'contents' => $faker->text(255),
        'reporting_time' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
