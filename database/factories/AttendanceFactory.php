<?php

use Faker\Generator as Faker;
use App\Models\Attendance;
use App\Models\User;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'registration_date' => $faker->date(),
        'absence_flg' => $faker->numberBetween(0, 1),
        'start_time' => $faker->time(),
        'end_time' => $faker->time(),
    ];
});
