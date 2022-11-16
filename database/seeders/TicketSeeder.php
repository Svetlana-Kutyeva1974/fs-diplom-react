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
            'qrCod' => Hash::make('qrCod1'),
            'seance_id' => 1,
            'film_id' => 1,
            'count' => 1000,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod2'),
            'seance_id' => 1,
            'film_id' => 2,
            'count' => 500,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod3'),
            'seance_id' => 1,
            'film_id' => 2,
            'count' => 1000,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod4'),
            'seance_id' => 3,
            'film_id' => 1,
            'count' => 500,
        ]);

        DB::table('tickets')->insert([
            'qrCod' => Hash::make('qrCod5'),
            'seance_id' => 2,
            'film_id' => 1,
            'count' => 500,
        ]);
    }
}
