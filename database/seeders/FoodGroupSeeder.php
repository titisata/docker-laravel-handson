<?php

namespace Database\Seeders;

use App\Models\FoodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodGroup::create([
            'experience_folder_id' => 1,
            'name' => '極上のご飯',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 1,
            'name' => '通常のご飯',
            'description' => 'まあまあおいしい！',
            'price_child' => 1500,
            'price_adult' => 3000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 6,
            'name' => '極上のご飯',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 6,
            'name' => '通常のご飯',
            'description' => 'まあまあおいしい！',
            'price_child' => 1500,
            'price_adult' => 3000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 7,
            'name' => '極上のご飯',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 7,
            'name' => '通常のご飯',
            'description' => 'まあまあおいしい！',
            'price_child' => 1500,
            'price_adult' => 3000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 8,
            'name' => '極上のご飯',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 8,
            'name' => '通常のご飯',
            'description' => 'まあまあおいしい！',
            'price_child' => 1500,
            'price_adult' => 3000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 9,
            'name' => '極上のご飯',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'experience_folder_id' => 9,
            'name' => '通常のご飯',
            'description' => 'まあまあおいしい！',
            'price_child' => 1500,
            'price_adult' => 3000,
        ]);
    }
}
