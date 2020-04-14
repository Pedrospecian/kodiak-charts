<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_positions', function (Blueprint $table) {
            $table->bigIncrements('list_position_id');
            $table->integer('position');
            $table->bigInteger('list_id')->unsigned();
            $table->bigInteger('song_id')->unsigned();
            $table->foreign('list_id')->references('list_id')->on('lists');
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
        Schema::dropIfExists('list_positions');
    }
}
