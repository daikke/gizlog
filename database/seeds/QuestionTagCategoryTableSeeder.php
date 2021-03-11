<?php

use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Database\Seeder;

class QuestionTagCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_tag_category')->truncate();
        factory(Question::class, 10)->create();
        $categoryIds = TagCategory::pluck('id');
        $categoriesCount = $categoryIds->count();
        $registerData = [];
        Question::pluck('id')->each(function ($questionId) use ($categoryIds, $categoriesCount, &$registerData) {
            $registerCount = rand(0, $categoriesCount);
            $categoryIds->random($registerCount)->each(function ($categoryId) use ($questionId, &$registerData) {
                $registerData[] = [
                    'tag_category_id' => $categoryId,
                    'question_id' => $questionId,
                ];
            });
        });
        DB::table('question_tag_category')->insert($registerData);
    }
}
