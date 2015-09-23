<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->primary(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_categories');
    }
}
