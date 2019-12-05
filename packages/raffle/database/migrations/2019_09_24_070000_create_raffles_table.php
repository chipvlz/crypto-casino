<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRafflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffles', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('ticket_price')->unsigned();
            $table->integer('max_tickets_per_user')->unsigned();
            $table->integer('total_tickets')->unsigned();
            $table->decimal('pot_size_pct', 6, 2);
            $table->decimal('win_amount', 10, 2)->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('status')->unsigned();
            $table->timestamps();
            // indexes
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raffles');
    }
}
