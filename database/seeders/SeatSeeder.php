<?php

namespace Database\Seeders;

use App\Models\Seance;
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
        //$seance= Seance::all()->count();
        $seances = Seance::all();
        //dump($seance);
        //dump($seances[1]->hall_id);
         foreach ($seances as $s) {
             for ($i = 1; $i <= 10; $i++) {
                 for ($j = 1; $j <= 12; $j++) {
                     DB::table('seats')->insert([
                         'hall_id' => $s['hall_id'],
                         'colNumber' => $j,
                         'rowNumber' => $i,
                         'type' => ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FAIL'])],
                         'ticket_id' => 0,
                         'seance_id' => $s['id'],
                          'free' => [true, false][array_rand([true, false])],
                     ]);
                 }
             }
         }
    }
}
