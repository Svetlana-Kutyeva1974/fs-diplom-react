<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('seats')->insert([
            'hall_id' => 1,
            'colNumber' => 12,
            'rowNumber' => '10',
            'type' => 'VIP',
            'ticket_id' => 0,
            'seance_id' => 50,
            //'free' => true,
        ]);
        DB::table('seats')->insert([
            'hall_id' => 1,
            'colNumber' => 12,
            'rowNumber' => '20',
            'type' => 'NORM',
            'ticket_id' => 0,
            'seance_id' => 56,
           // 'free' => true,
        ]);*/
        for($s=1; $s<=5; $s++) {
            for ($i = 1; $i <= 10; $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    //dump($i);
                    DB::table('seats')->insert([
                        'hall_id' => 1,
                        'colNumber' => $j,
                        'rowNumber' => $i,
                        'type' => 'NORM',
                        'ticket_id' => 0,
                        'seance_id' => $s,
                        // 'free' => true,
                    ]);
                }
            }
        }
        /*DB::table('seats')->insert([
            'hall_id' => 2,
            'colNumber' => 12,
            'rowNumber' => '10',
            'type' => 'VIP',
            'ticket_id' => 0,
            'seance_id' => 25,
            //'free' => true,
        ]);
        DB::table('seats')->insert([
            'hall_id' => 2,
            'colNumber' => 12,
            'rowNumber' => '20',
            'type' => 'NORM',
            'ticket_id' => 0,
            'seance_id' => 1,
            // 'free' => true,
        ]);*/
    }
}
