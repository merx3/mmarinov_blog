<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('description', 155);
            $table->string('slug')->unique();
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
            $table->text('content');
            $table->string('photo_path');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->index();
            $table->integer('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
