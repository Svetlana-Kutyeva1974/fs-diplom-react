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
                     if(($s['id'] >= 1 && $s['id'] <=5) && (($i===1 && $j===1) || ($i===1 && $j===2) || ($i===1 && $j===4) || ($i===1 && $j===5) || ($i===1 && $j===3) || ($i===1 && $j===6))) {
                         $ticket_id = $j;
                         $free = false;
                         //$hall_id= 1;
                     } else {
                         $ticket_id = 0;
                         $free = true;
                         //$hall_id = $s['hall_id'];
                     }
                     /*if ($s['id'] !==1){
                         $free = true;
                     }*/
                     DB::table('seats')->insert([
                         'hall_id' =>  $s['hall_id'],
                         'colNumber' => $j,
                         'rowNumber' => $i,
                         //'type' => ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FAIL'])],
                         'ticket_id' => $ticket_id,
                         'seance_id' => $s['id'],
                          'free' => $free, //[true, false][array_rand([true, false])],
                     ]);
                 }
             }
         }
    }
}
//  'free' => ($s['hall_id'] === 1) ? $free : true,
