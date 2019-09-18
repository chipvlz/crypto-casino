<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameMultiSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_multi_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lines_bet'); // number of lines bet
            $table->decimal('bet_amount', 10, 2);
            $table->integer('lines_win'); // number of lines won
            $table->integer('scatters_count'); // scatter symbols
            $table->string('reel_positions', 50); // end reel positions (comma-separated), e.g. 9,27,26,23,15
            $table->integer('game_index')->nullable(); // multi slots game index
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
        Schema::dropIfExists('game_multi_slots');
    }
}
