<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
        Comment::create(array(
            'comment_text' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis voluptate reprehenderit assumenda eum, molestiae hic dignissimos explicabo rem architecto. Numquam maxime praesentium in consequatur eos, error officiis autem porro natus!',
            'user_id' => 1,
            'post_id' => 2,
        ));

        Comment::create(array(
            'comment_text' => 'error officiis autem porro natus!:))',
            'user_id' => 3,
            'post_id' => 2,
        ));

        Comment::create(array(
            'comment_text' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis voluptate reprehenderit assumenda eum, molestiae hic dignissimos explicabo rem architecto. Numquam maxime praesentium in consequatur eos, error officiis autem porro natus!',
            'user_id' => 2,
            'post_id' => 3,
        ));
        Comment::create(array(
            'comment_text' => 'Lorem ',
            'user_id' => 1,
            'post_id' => 2,
        ));
        Comment::create(array(
            'comment_text' => ':)',
            'user_id' => 2,
            'post_id' => 2,
        ));
    }
}
