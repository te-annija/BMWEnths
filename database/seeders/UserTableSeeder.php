<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create(array(
            'name' => 'Organizer',
            'email' => 'org@bmw.test',
            'password' => Hash::make('password'),
            'role' => 1,
        ));
        User::create(array(
            'name' => 'Test User 1',
            'email' => 'test1@bmw.test',
            'password' => Hash::make('password'),
            'role' => 0,
        ));
        User::create(array(
            'name' => 'Test User 2',
            'email' => 'test2@bmw.test',
            'password' => Hash::make('password'),
            'role' => 0,
        ));
        User::create(array(
            'name' => 'Administrator',
            'email' => 'admin@bmw.test',
            'password' => Hash::make('password'),
            'role' => 100,
        ));

    }
}
