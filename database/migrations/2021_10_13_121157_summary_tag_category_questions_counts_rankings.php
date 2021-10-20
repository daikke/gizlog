<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SummaryTagCategoryQuestionsCountsRankings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_tag_category_questions_counts_rankings', function (Blueprint $table) {
            $table->integer('tag_category_id')->unsigned();
            $table->integer('rank')->unsigned()->index();
            $table->integer('questions_count')->unsigned();

            $table->primary('tag_category_id', 'category_rankings_primary');
            $table->foreign('tag_category_id', 'foreign_tag_category_id')->references('id')->on('tag_categories');
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
        Schema::dropIfExists('summary_tag_category_questions_counts_rankings');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
