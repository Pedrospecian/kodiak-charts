<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subgenres', function (Blueprint $table) {
            $table->bigIncrements('subgenre_id');
            $table->string('name');
            $table->bigInteger('genre_id')->unsigned();
            $table->foreign('genre_id')->references('genre_id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subgenres');
    }
}
