<?php

use App\Models\ModifyRequest;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(ModifyRequest::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'registration_date' => $faker->date(),
        'reason' => $faker->text(),
    ];
});
