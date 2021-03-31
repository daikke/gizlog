<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTagCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_tag_category', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('tag_category_id')->unsigned();
            $table->primary(['question_id', 'tag_category_id']);
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('tag_category_id')->references('id')->on('tag_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_tag_category');
    }
}
