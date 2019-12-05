<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaffleTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffle_tickets', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('raffle_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->tinyInteger('winner')->unsigned()->default(0);
            $table->timestamps();
            // foreign keys
            $table->foreign('raffle_id')->references('id')->on('raffles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            // indexes
            $table->index('winner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raffle_tickets');
    }
}
