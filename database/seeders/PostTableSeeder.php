<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Post::create(array(
            'type' => 1,
            'title' => 'First Post',
            'description' => 'First post description. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'file_path' => 'test1_img.jpg',
            'user_id' => 1,
        ));
        Post::create(array(
            'type' => 1,
            'title' => 'Test 1 post',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'file_path' => 'test2_img.jpg',
            'user_id' => 2,
        ));
        Post::create(array(
            'type' => 1,
            'title' => 'Test 2 Post',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
            'file_path' => 'test3_img.jpg',
            'user_id' => 3,
        ));
        Post::create(array(
            'type' => 2,
            'title' => 'Question by Admin',
            'description' => 'Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'user_id' => 1,
        ));
        Post::create(array(
            'type' => 2,
            'title' => 'Question by Test 1',
            'description' => ' Modi, nemo perferendis possimus at repudiandae facere ullam. Totam modi veritatis doloribus. Nobis culpa dolor suscipit praesentium quis tenetur esse, autem non?',
            'file_path' => 'test2_img.jpg',
            'user_id' => 2,
        ));
        Post::create(array(
            'type' => 2,
            'title' => 'Question by Test 2',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati fugit voluptatibus maiores eos minus totam corrupti et consequatur neque quo temporibus inventore autem reiciendis, numquam, adipisci aliquid nesciunt qui amet.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum impedit incidunt, tempore ipsum rerum adipisci commodi veniam ullam eos aspernatur harum eum dolore cum, dolores distinctio quas, similique odio fugiat!',
            'file_path' => 'test3_img.jpg',
            'user_id' => 3,
        ));

    }
}
