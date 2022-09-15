<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food::create([
            'name' => '極上海鮮',
            'description' => 'とってもおいしい海鮮！',
        ]);
        Food::create([
            'name' => '極上中華',
            'description' => 'とってもおいしい中華！',
        ]);
        Food::create([
            'name' => '通常海鮮',
            'description' => 'まあまあおいしい海鮮！',
        ]);
        Food::create([
            'name' => '通常中華',
            'description' => 'まあまあおいしい中華！',
        ]);
    }
}
