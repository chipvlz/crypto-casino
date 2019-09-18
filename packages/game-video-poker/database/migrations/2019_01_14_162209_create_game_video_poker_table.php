<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameVideoPokerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_video_poker', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->tinyInteger('bet_coins'); // 1-5
            $table->decimal('bet_amount', 10, 2);
            $table->string('deck', 160); // comma-separated card deck, e.g. h2,st,da
            $table->string('hold', 15)->nullable(); // comma-separated list of cards, which were held after the first draw, e.g. 1,5
            $table->mediumInteger('combination')->nullable();
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
        Schema::dropIfExists('game_video_poker');
    }
}
