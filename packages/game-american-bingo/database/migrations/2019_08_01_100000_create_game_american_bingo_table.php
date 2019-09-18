<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameAmericanBingoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_american_bingo', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('card', 100)->nullable(); // 24 numbers
            $table->string('balls', 200)->nullable(); // 35 balls or more
            $table->string('win_patterns', 100)->nullable();
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
        Schema::dropIfExists('game_american_bingo');
    }
}
