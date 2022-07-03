<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Experience::create([
            'experience_folder_id' => 1,
            'name' => '13:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
        \App\Models\Experience::create([
            'experience_folder_id' => 1,
            'name' => '15:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
        \App\Models\Experience::create([
            'experience_folder_id' => 2,
            'name' => '13:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
        \App\Models\Experience::create([
            'experience_folder_id' => 2,
            'name' => '15:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
        \App\Models\Experience::create([
            'experience_folder_id' => 3,
            'name' => '13:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
        \App\Models\Experience::create([
            'experience_folder_id' => 3,
            'name' => '15:00からの部',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'sort_no' => 1,
            'quantity' => 5,
            'price_child' => 5000,
            'price_adult' => 7000,
        ]);
    }
}
