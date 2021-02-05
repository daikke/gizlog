<?php

use App\Models\DailyReport;
use Illuminate\Database\Seeder;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        factory(DailyReport::class, 10)->create();
    }
}
