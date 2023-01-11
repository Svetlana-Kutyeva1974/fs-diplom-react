<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('free')->default(true);
            $table->integer('colNumber');
            $table->integer('rowNumber');
            $table->integer('hall_id');//связь?

            $table->integer('ticket_id')->default(0);//связь
            //$table->unsignedBigInteger('ticket_id')->default(0);
            //$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            //$table->integer('seance_id');
            $table->unsignedBigInteger('seance_id');
            $table->foreign('seance_id')->references('id')->on('seances')->onDelete('cascade');;//связь
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
