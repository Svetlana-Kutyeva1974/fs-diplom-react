<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seances')->insert([
            'startSeance' => 780,
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:30:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:30:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:30:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);
    }
}
