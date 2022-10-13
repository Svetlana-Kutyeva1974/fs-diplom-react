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
            $table->integer('count');
            $table->integer('id_film')->unique();
            $table->integer('id_seance')->unique();
            $table->integer('id_seat');//связь
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
