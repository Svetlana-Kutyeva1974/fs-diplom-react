<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('admin'),
            'is_admin' => 1,
        ]);
        Admin::create([
            'name' => 'Svetlana Kutyeva',
            'email' => 'kutyovas@yandex.ru',
            'password' => '12345678',
            'is_admin' => 1,
        ]);

    }
}
