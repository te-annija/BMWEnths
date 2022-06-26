<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventparticipationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventparticipation')->truncate();
        DB::table('eventparticipation')->insert([
            'user_id' => 2,
            'event_id' => 2,
        ]);
        DB::table('eventparticipation')->insert([
            'user_id' => 3,
            'event_id' => 3,
        ]);
        DB::table('eventparticipation')->insert([
            'user_id' => 2,
            'event_id' => 1,
        ]);
        
    }
}
