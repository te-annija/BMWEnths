<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();
        Event::create(array(
            'image_path' => 'event1.jpg',
            'title' => 'First Event',
            'location' => 'Rīga, Biķernieku trase',
            'date' => '2022-05-11',
            'description' => 'First description. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'registred' => 45,
            'status' => -1,
            'user_id' => 1,
        ));
        Event::create(array(
            'image_path' => 'event2.jpg',
            'title' => 'Second Event',
            'location' => 'Rīga, Biķernieku trase, no otras puses',
            'date' => '2022-07-30',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'registred' => 10,
            'status' => 1,
            'user_id' => 1,
        ));
        Event::create(array(
            'image_path' => 'event3.jpg',
            'title' => 'Third Event',
            'location' => 'Alūksne, Mazā Stacijas iela 3',
            'date' => '2022-08-15',
            'description' => 'First description. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'registred' => 5,
            'status' => 1,
            'user_id' => 1,
        ));

    }
}
