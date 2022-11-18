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
            $table->id();//$table->integer('id_seat')->unique();
            $table->timestamps();
            //$table->string('type');//VIP/NORM/FAIL
            $table->boolean('free')->default(true);
            $table->integer('colNumber');
            $table->integer('rowNumber');
            $table->integer('hall_id');//связь
            $table->integer('ticket_id')->default(0);//связь
            $table->integer('seance_id');//связь
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
