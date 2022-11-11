<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->integer('id_ticket')->unique();
            //$table->integer('colNumber');
            //$table->integer('rowNumber');
            $table->string('qrCod');//
            $table->integer('count');
            //$table->integer('count');
            $table->integer('film_id');
            $table->integer('seance_id');
            $table->integer('seat_id');//связь
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
