<?php

namespace Database\Seeders;

use App\Models\FoodSelect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FoodSelect::create([
            'food_group_id' => '1',
            'food_id' => '1',
        ]);
        FoodSelect::create([
            'food_group_id' => '2',
            'food_id' => '1',
        ]);
        FoodSelect::create([
            'food_group_id' => '3',
            'food_id' => '1',
        ]);
        FoodSelect::create([
            'food_group_id' => '4',
            'food_id' => '1',
        ]);
        FoodSelect::create([
            'food_group_id' => '1',
            'food_id' => '2',
        ]);
        FoodSelect::create([
            'food_group_id' => '2',
            'food_id' => '2',
        ]);
        FoodSelect::create([
            'food_group_id' => '3',
            'food_id' => '2',
        ]);
        FoodSelect::create([
            'food_group_id' => '4',
            'food_id' => '2',
        ]);
        FoodSelect::create([
            'food_group_id' => '6',
            'food_id' => '3',
        ]);
        FoodSelect::create([
            'food_group_id' => '7',
            'food_id' => '3',
        ]);
        FoodSelect::create([
            'food_group_id' => '8',
            'food_id' => '3',
        ]);
        FoodSelect::create([
            'food_group_id' => '9',
            'food_id' => '3',
        ]);
        FoodSelect::create([
            'food_group_id' => '6',
            'food_id' => '4',
        ]);
        FoodSelect::create([
            'food_group_id' => '7',
            'food_id' => '4',
        ]);
        FoodSelect::create([
            'food_group_id' => '8',
            'food_id' => '4',
        ]);
        FoodSelect::create([
            'food_group_id' => '9',
            'food_id' => '4',
        ]);
    
    }
}
