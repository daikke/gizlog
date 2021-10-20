<?php

use App\Models\Question;
use Illuminate\Database\Seeder;

class SummaryTagCategoryQuestionsCountsRankingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = app()->make(Question::class);
        $rankings = $question->fetchTagCategoryQuestionsCountsRankings();
        $rankings->map(function ($row, $key) {
            $row->rank = $key + 1;
        });

        DB::table('summary_tag_category_questions_counts_rankings')->truncate();
        DB::table('summary_tag_category_questions_counts_rankings')->insert($rankings->toArray());
    }
}
