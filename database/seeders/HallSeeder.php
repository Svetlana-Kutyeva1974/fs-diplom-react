<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seats =[];
        for ($i = 1; $i <= 10; $i++) {
            //$seats =[$i][];
            for ($j = 1; $j <= 12; $j++) {
                //$ii="$i$j";
                $seats["$i,$j"] = ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FIRE'])];
            }
        }
        //dump($seats);
        $seats = json_encode($seats);
        DB::table('halls')->insert([
            'nameHall' => 'Зал 1',
            'col' => 12,
            'row' => '10',
            'countVip' => 1000,
            'countNormal' => 500,
            'open'=> true,
            'typeOfSeats' => $seats,

        ]);
        DB::table('halls')->insert([
            'nameHall' => 'Зал 2',
            'col' => 12,
            'row' => '10',
            'countVip' => 1000,
            'countNormal' => 500,
            'open'=> true,
            'typeOfSeats' => $seats,
        ]);
    }
}
