<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        //$now1 = substr(Carbon\$day,0, 10).' '.'10:30:22';
        //$now2 = substr(Carbon\$day,0, 10).' '.'11:15:22';
        //$now3 = substr(Carbon\$day,0, 10).' '.'09:00:22';
        //for ($i = 0; $i <= 6; $i += 2) {
            /*if ($i=0) {
                $day= Carbon::now();
            }
            else {
                $day= Carbon::now()->addDay();
            }*/

        //$day= Carbon::now();

        //1 фильм 1 зал
        DB::table('seances')->insert([
            'startSeance' => Carbon::now(),
            'film_id' => 1,
            'hall_id' => 1,
        ]);


        //--------------------


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(330),
            'film_id' => 1,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(660),
            'film_id' => 1,
            'hall_id' => 1,
        ]);
        /*
       DB::table('seances')->insert([
           'startSeance' => Carbon::now()->addMinutes(720),
           'film_id' => 1,
           'hall_id' => 1,
       ]);

       DB::table('seances')->insert([
           'startSeance' => Carbon::now()->addMinutes(130),
           'film_id' => 1,
           'hall_id' => 1,
       ]);*/

        //1 фильм 2 зал
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50),//'startSeance' => Carbon::now()->addMinutes(210),
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(280),//'startSeance' => Carbon::now()->addMinutes(420),
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(510),
            'film_id' => 1,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(740),
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(970),
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(1200),
            'film_id' => 1,
            'hall_id' => 2,
        ]);


        /*2*/////1 зал

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(130),
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(130+330),
            'film_id' => 2,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(130+660),
            'film_id' => 2,
            'hall_id' => 1,
        ]);
        /*
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(560),
            'film_id' => 2,
            'hall_id' => 1,
        ]);
        */
        /////////////////////////2 фильм 2 зал
        /*DB::table('seances')->insert([
            'startSeance' => Carbon::now(),
            'film_id' => 2,
            'hall_id' => 2,
        ]);
        */
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50+130),
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50+130+230),
            'film_id' => 2,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50+130+460),
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50+130+690),
            'film_id' => 2,
            'hall_id' => 2,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(50+130+920),
            'film_id' => 2,
            'hall_id' => 2,
        ]);

        /*
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(1260),
            'film_id' => 2,
            'hall_id' => 2,
        ]);
*/
        //.............3фильм 1 зал
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(230),
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(230+330),
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(230+660),
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        /*
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(390),
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(420),
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(550),
            'film_id' => 3,
            'hall_id' => 1,
        ]);

        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(680),
            'film_id' => 3,
            'hall_id' => 1,
        ]);


        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(820),
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(950),
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(1080),
            'film_id' => 3,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'startSeance' => Carbon::now()->addMinutes(1210),
            'film_id' => 3,
            'hall_id' => 1,
        ]);*/

    }
}
