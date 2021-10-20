<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SummaryUserCommentsCountsRankings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_user_comments_counts_rankings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->primary();
            $table->integer('rank')->unsigned()->index();
            $table->integer('comments_count')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('summary_user_comments_counts_rankings');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
