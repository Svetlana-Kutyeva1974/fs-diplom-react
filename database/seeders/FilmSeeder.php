<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
            'title' => 'Звёздные войны XXIII: Атака клонированных клонов',
            'description' => 'Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.',
            'duration' => 130,
            'origin' => 'CША',
            'imageText' => 'Звёздные войны постер',
            'imagePath' => 'i/poster1.jpg'
        ]);

        DB::table('films')->insert([
            'title' => 'Альфа',
            'description' => '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.',
            'duration' => 96,
            'origin' => 'Франция',
            'imageText' => 'Альфа постер',
            'imagePath' => 'i/poster2.jpg'
        ]);

        DB::table('films')->insert([
            'title' => 'Хищник',
            'description' => 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.',
            'duration' => 101,
            'origin' => 'Канада, CША',
            'imageText' => 'Хищник постер',
            'imagePath' => 'i/poster1.jpg'
        ]);
    }
}
