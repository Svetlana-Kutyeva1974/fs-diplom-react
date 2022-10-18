<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tickets')->insert([
            //'date' => date_format(date_create('now'), 'Y-m-d'),
            'qrCod' => Hash::make('qrCod'),
            'seance_id' => 1,
            'film_id' => 1,
            'seat_id' => 1,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod'),
            'seance_id' => 1,
            'film_id' => 2,
            'seat_id' => 2,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod'),
            'seance_id' => 1,
            'film_id' => 2,
            'seat_id' => 3,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod'),
            'seance_id' => 3,
            'film_id' => 1,
            'seat_id' => 4,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod'),
            'seance_id' => 2,
            'film_id' => 1,
            'seat_id' => 5,
        ]);
    }
}
