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
            'startSeance' => '2022-12-05 10:20:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:10:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:40:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 22:00:22',
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:30:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 11:15:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:40:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 16:00:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:30:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 21:00:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 23:30:22',
            'film_id' => 1,
            'hall_id' => 2,
        ]);
        /*2*/

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:20:22',
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:10:22',
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:40:22',
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 22:00:22',
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:30:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 11:15:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:40:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 16:00:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:30:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 21:00:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 23:30:22',
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        //3
        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 09:00:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 10:10:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 12:55:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:15:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 14:50:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 16:30:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:00:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);


        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 18:50:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 19:50:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 20:50:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => '2022-12-05 22:00:22',
            'film_id' => 3,
            'hall_id' => 1,
        ]);
    }
}
