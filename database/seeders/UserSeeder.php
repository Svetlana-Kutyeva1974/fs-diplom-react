<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\User;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.ru',
            'password' => Hash::make('12345678'),
            'is_admin' => 0,
        ]);
        User::create([
            'name' => 'Svetlana Kutyeva',
            'email' => 'kutyovas@yandex.ru',
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('admin'),
            'is_admin' => 1,
        ]);
    }
}
