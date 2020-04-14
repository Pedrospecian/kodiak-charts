<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsMadeSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists_made_song', function (Blueprint $table) {
            $table->bigIncrements('artist_made_song_id');
            $table->bigInteger('artist_id')->unsigned();
            $table->bigInteger('song_id')->unsigned();
            $table->foreign('artist_id')->references('artist_id')->on('artists');
            $table->foreign('song_id')->references('song_id')->on('songs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists_made_song');
    }
}
