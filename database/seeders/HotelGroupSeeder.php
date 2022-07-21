<?php

namespace Database\Seeders;

use App\Models\HotelGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HotelGroup::create([
            'experience_folder_id' => 1,
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテル！',
            'price_child' => 20000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 1,
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテル！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 6,
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテル！',
            'price_child' => 20000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 6,
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテル！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 7,
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテル！',
            'price_child' => 20000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 7,
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテル！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 8,
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテル！',
            'price_child' => 20000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 8,
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテル！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 9,
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテル！',
            'price_child' => 20000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'experience_folder_id' => 9,
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテル！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
    }
}
