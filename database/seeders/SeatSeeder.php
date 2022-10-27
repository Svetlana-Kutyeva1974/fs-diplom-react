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
        DB::table('seats')->insert([
            'hall_id' => 1,
            'colNumber' => 12,
            'rowNumber' => '10',
            'type' => '1000',
            //'free' => true,
        ]);
        DB::table('seats')->insert([
            'hall_id' => 2,
            'colNumber' => 12,
            'rowNumber' => '20',
            'type' => '1000',
           // 'free' => true,
        ]);
    }
}
