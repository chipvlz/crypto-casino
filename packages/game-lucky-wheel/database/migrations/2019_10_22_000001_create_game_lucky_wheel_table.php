<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameLuckyWheelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_lucky_wheel', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('position')->unsigned(); // wheel position index
            $table->tinyInteger('game_index')->unsigned()->nullable(); // lucky wheel game index
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
        Schema::dropIfExists('game_lucky_wheel');
    }
}
