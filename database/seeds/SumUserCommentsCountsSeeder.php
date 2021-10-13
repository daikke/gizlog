<?php

use App\Models\Comment;
use Illuminate\Database\Seeder;

class SummaryUserCommentsCountsRankingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = app()->make(Comment::class);
        $rankings = $comment->fetchUserCommentsCountsRankings();
        $rankings->map(function ($row, $key) {
            return $row['rank'] = $key + 1;
        });

        DB::table('summary_user_comments_counts_rankings')->truncate();
        DB::table('summary_user_comments_counts_rankings')->insert($rankings->toArray());
    }
}
