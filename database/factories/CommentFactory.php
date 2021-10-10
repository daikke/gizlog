<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 500),
        'question_id' => rand(1, 5000),
        'content' => $faker->text(255),
    ];
});
