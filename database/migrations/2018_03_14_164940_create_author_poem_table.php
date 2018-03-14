<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorPoemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_poem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')
              ->on('authors')->onDelete('cascade');
            $table->integer('poem_id')->unsigned()->nullable();
            $table->foreign('poem_id')->references('id')
              ->on('poems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_poem');
    }
}
