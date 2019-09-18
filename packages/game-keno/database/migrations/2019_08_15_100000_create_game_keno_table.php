<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameKenoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_keno', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('bet_numbers', 50)->nullable(); // 10 numbers
            $table->string('draw_numbers', 200)->nullable(); // 20 numbers
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
        Schema::dropIfExists('game_keno');
    }
}
