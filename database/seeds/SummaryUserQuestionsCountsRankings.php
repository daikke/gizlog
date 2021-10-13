<?php

use App\Models\Question;
use Illuminate\Database\Seeder;

class SummaryUserQuestionsCountsRankings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = app()->make(Question::class);
        $rankings = $question->fetchUserQuestionsCountsRankings();
        $rankings->map(function ($row, $key) {
            return $row['rank'] = $key + 1;
        });

        DB::table('summary_user_questions_counts_rankings')->truncate();
        DB::table('summary_user_questions_counts_rankings')->insert($rankings->toArray());
    }
}
