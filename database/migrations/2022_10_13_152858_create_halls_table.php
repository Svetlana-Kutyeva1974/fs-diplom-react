<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $seats = [];
        for ($i = 1; $i <= 10; $i++) {
            //$seats =[$i][];
            for ($j = 1; $j <= 12; $j++) {
                //$ii="$i$j";
                $seats["$i,$j"] = ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FIRE'])];
            }
        }
        $seats = json_encode($seats);

        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nameHall');
            $table->integer('col')->default(12);;
            $table->integer('row')->default(10);;
            $table->integer('countVip')->default(1000);;
            $table->integer('countNormal')->default(500);;
            //$table->json('typeOfSeats')->default(new Expression('(JSON_ARRAY())'));
            $table->json('typeOfSeats')->default(new Expression('($seats)'));
            $table->boolean('open')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
}
