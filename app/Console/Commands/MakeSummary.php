<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SumUserCommentsCountsSeeder;
use SumUserQuestionsCountsSeeder;
use SumCategoryQuestionsCountsSeeder;

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
    protected $description = 'Make Some Summary Tables;';

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
        app()->make(SumUserCommentsCountsSeeder::class)->run();
        app()->make(SumUserQuestionsCountsSeeder::class)->run();
        app()->make(SumCategoryQuestionsCountsSeeder::class)->run();
    }
}
