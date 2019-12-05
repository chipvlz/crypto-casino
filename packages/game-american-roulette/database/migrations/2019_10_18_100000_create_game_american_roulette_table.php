<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameAmericanRouletteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_american_roulette', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('bets', 1000)->nullable(); // player bets
            $table->string('wins', 1000)->nullable(); // player wins
            $table->tinyInteger('position')->unsigned(); // roulette ball position index (number 0-36)
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
        Schema::dropIfExists('game_american_roulette');
    }
}
