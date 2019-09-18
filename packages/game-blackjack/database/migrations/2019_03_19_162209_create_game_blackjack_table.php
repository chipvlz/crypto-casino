<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameBlackjackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_blackjack', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('deck', 160); // comma-separated card deck, e.g. h2,st,da
            // player hand
            $table->decimal('bet', 10, 2);
            $table->decimal('win', 10, 2);
            $table->decimal('insurance_bet', 10, 2)->default(0); // insurance bet
            $table->decimal('insurance_win', 10, 2)->default(0); // insurance win
            $table->string('player_hand', 50)->nullable();
            $table->tinyInteger('player_score')->nullable()->unsigned();
            $table->boolean('player_blackjack')->default(0); // whether player has BJ (1) or not (0)
            // 2nd player hand (in case of split)
            $table->decimal('bet2', 10, 2)->default(0);
            $table->decimal('win2', 10, 2)->default(0);
            $table->string('player_hand2', 50)->nullable();
            $table->tinyInteger('player_score2')->nullable()->unsigned();
            // dealer hand
            $table->string('dealer_hand', 50)->nullable();
            $table->tinyInteger('dealer_score')->nullable()->unsigned();
            $table->boolean('dealer_blackjack')->default(0); // whether dealer has BJ (1) or not (0)

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
        Schema::dropIfExists('game_blackjack');
    }
}
