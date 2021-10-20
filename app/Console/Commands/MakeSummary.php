<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SummaryUserCommentsCountsRankingsSeeder;
use SummaryUserQuestionsCountsRankingsSeeder;
use SummaryTagCategoryQuestionsCountsRankingsSeeder;

class MakeSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '各種サマリーテーブルへの集計データインサート';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app()->make(SummaryUserCommentsCountsRankingsSeeder::class)->run();
        app()->make(SummaryUserQuestionsCountsRankingsSeeder::class)->run();
        app()->make(SummaryTagCategoryQuestionsCountsRankingsSeeder::class)->run();
    }
}
