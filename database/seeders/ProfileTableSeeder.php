<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::truncate();
        Profile::create(array(
            'BMW_model' => 'e36 323i',
            'body_type' => 'Sedan',
            'year' => '1995',
            'engine' => '2494',
            'power' => '125', //kw
            'description' => 'e36 car lover',
            'image_path' => 'admin_img.jpg',
            'user_id' => 1,
        ));

        Profile::create(array(
            'BMW_model' => 'X5 M',
            'body_type' => 'SUV ',
            'year' => '2020',
            'engine' => '4395',
            'power' => '441', //kw
            'user_id' => 2,
        ));
        Profile::create(array(
            'BMW_model' => 'e46 320i',
            'body_type' => 'Sedan',
            'year' => '2001',
            'engine' => '2171',
            'power' => '125', //kw
            'image_path' =>'user2_img.jpg',
            'user_id' => 3,
        ));

    }
}
