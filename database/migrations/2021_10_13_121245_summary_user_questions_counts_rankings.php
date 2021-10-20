<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SummaryUserQuestionsCountsRankings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_user_questions_counts_rankings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->primary();
            $table->integer('rank')->unsigned()->index();
            $table->integer('questions_count')->unsigned();

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
        Schema::dropIfExists('summary_user_questions_counts_rankings');
    }
}
