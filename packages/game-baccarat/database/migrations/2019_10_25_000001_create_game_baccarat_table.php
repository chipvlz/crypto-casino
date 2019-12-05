<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameBaccaratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_baccarat', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('deck', 280)->nullable(); // comma-separated card deck, e.g. h2,st,da
            $table->tinyInteger('bet_type')->nullable()->unsigned();
            // player hand
            $table->string('player_hand', 20)->nullable();
            $table->tinyInteger('player_total')->nullable()->unsigned();
            // banker hand
            $table->string('banker_hand', 20)->nullable();
            $table->tinyInteger('banker_total')->nullable()->unsigned();
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
        Schema::dropIfExists('game_baccarat');
    }
}
