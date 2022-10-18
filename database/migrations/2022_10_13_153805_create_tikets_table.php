<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->integer('id_ticket')->unique();
            //$table->integer('colNumber');
            //$table->integer('rowNumber');
            $table->string('qrCod');//
            //$table->integer('count');
            $table->integer('film_id')->unique();
            $table->integer('seance_id')->unique();
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
        Schema::dropIfExists('tikets');
    }
}
