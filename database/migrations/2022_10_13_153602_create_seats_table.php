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
            //$table->integer('id_seat')->unique();
            $table->string('type');
            $table->boolean('free')->default(true);
            $table->integer('colNumber');
            $table->integer('rowNumber');
            $table->integer('hall_id')->default(1);//связь
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
