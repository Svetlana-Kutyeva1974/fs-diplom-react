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
        DB::table('halls')->insert([
            'nameHall' => 'Зал 1',
            'col' => 12,
            'row' => '10',
            'countVip' => 1000,
            'countNormal' => 500,
        ]);
        DB::table('halls')->insert([
            'nameHall' => 'Зал 2',
            'col' => 12,
            'row' => '20',
            'countVip' => 1000,
            'countNormal' => 500,
        ]);
    }
}
