<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            HallSeeder::class,
            AdminSeeder::class,
            FilmSeeder::class,
            SeanceSeeder::class,
            TicketSeeder::class,
            SeatSeeder::class,
        ]);
    }
}

//php artisan migrate:fresh
//php artisan db:seed











//php artisan db:seed --class=UserSeeder
