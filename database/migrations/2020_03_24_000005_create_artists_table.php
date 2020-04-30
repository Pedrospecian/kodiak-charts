<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->bigIncrements('artist_id');
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('genre_id')->unsigned();
            $table->bigInteger('subgenre_id_1')->unsigned();
            $table->bigInteger('subgenre_id_2')->unsigned();
            $table->bigInteger('subgenre_id_3')->unsigned();
            $table->foreign('country_id')->references('country_id')->on('countries');
            $table->foreign('genre_id')->references('genre_id')->on('genres');
            $table->foreign('subgenre_id_1')->nullable()->references('subgenre_id')->on('subgenres');
            $table->foreign('subgenre_id_2')->nullable()->references('subgenre_id')->on('subgenres');
            $table->foreign('subgenre_id_3')->nullable()->references('subgenre_id')->on('subgenres');
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
        Schema::dropIfExists('artists');
    }
}
