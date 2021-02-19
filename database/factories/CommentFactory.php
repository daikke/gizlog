<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    $testUserIds = [1, 2, 3, 4];
    $testQuestionIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    return [
        'user_id' => $testUserIds[array_rand($testUserIds, 1)],
        'question_id' => $testQuestionIds[array_rand($testQuestionIds, 1)],
        'content' => $faker->text(255),
    ];
});
