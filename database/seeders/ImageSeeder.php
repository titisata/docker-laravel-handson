<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'image_path' => '/images/1.jpg',
            'table_name' => 'experience_folders',
            'table_id' => 1,
        ]);
        Image::create([
            'image_path' => '/images/2.jpg',
            'table_name' => 'experience_folders',
            'table_id' => 2,
        ]);
        Image::create([
            'image_path' => '/images/3.jpg',
            'table_name' => 'experience_folders',
            'table_id' => 3,
        ]);
    }
}
