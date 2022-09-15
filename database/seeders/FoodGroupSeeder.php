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
            'name' => '極上のご飯A',
            'description' => 'とってもおいしい！',
            'price_child' => 5000,
            'price_adult' => 6000,
        ]);
        FoodGroup::create([
            'name' => '極上のご飯B',
            'description' => 'まあまあおいしい！',
            'price_child' => 4000,
            'price_adult' => 5000,
        ]);
        FoodGroup::create([
            'name' => '極上のご飯C',
            'description' => 'とってもおいしい！',
            'price_child' => 3000,
            'price_adult' => 4000,
        ]);
        FoodGroup::create([
            'name' => '極上のご飯D',
            'description' => 'まあまあおいしい！',
            'price_child' => 2000,
            'price_adult' => 3000,
        ]);
        FoodGroup::create([
            'name' => '極上のご飯E',
            'description' => 'とってもおいしい！',
            'price_child' => 1000,
            'price_adult' => 2000,
        ]);
        FoodGroup::create([
            'name' => '通常のご飯A',
            'description' => 'まあまあおいしい！',
            'price_child' => 1000,
            'price_adult' => 1500,
        ]);
        FoodGroup::create([
            'name' => '通常のご飯B',
            'description' => 'とってもおいしい！',
            'price_child' => 800,
            'price_adult' => 1000,
        ]);
        FoodGroup::create([
            'name' => '通常のご飯C',
            'description' => 'まあまあおいしい！',
            'price_child' => 700,
            'price_adult' => 900,
        ]);
        FoodGroup::create([
            'name' => '通常のご飯D',
            'description' => 'とってもおいしい！',
            'price_child' => 600,
            'price_adult' => 800,
        ]);
        FoodGroup::create([
            'name' => '通常のご飯E',
            'description' => 'まあまあおいしい！',
            'price_child' => 600,
            'price_adult' => 750,
        ]);
    }
}
