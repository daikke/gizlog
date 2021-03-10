<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Question::class, function (Faker $faker) {
    $testUserIds = [1, 2, 3, 4];
    $testCategoryIds = [1, 2, 3, 4];
    return [
        'user_id' => $testUserIds[array_rand($testUserIds, 1)],
        'tag_category_id' => $testCategoryIds[array_rand($testCategoryIds, 1)],
        'title' => $faker->word,
        'content' => $faker->text(255),
    ];
});
