<?php

namespace Database\Seeders;

use App\Models\FoodGroupSelect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodGroupSelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FoodGroupSelect::create([
            'experience_folder_id' => '1',
            'food_group_id' => '1',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '1',
            'food_group_id' => '2',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '6',
            'food_group_id' => '1',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '6',
            'food_group_id' => '1',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '7',
            'food_group_id' => '6',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '7',
            'food_group_id' => '7',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '7',
            'food_group_id' => '8',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '8',
            'food_group_id' => '9',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '8',
            'food_group_id' => '10',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '9',
            'food_group_id' => '9',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '10',
            'food_group_id' => '1',
        ]);
        FoodGroupSelect::create([
            'experience_folder_id' => '10',
            'food_group_id' => '6',
        ]);
    }
}
