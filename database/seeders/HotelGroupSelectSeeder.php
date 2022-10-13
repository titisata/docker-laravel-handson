<?php

namespace Database\Seeders;

use App\Models\HotelGroupSelect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelGroupSelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HotelGroupSelect::create([
            'experience_folder_id' => '1',
            'hotel_group_id' => '1',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '1',
            'hotel_group_id' => '2',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '6',
            'hotel_group_id' => '1',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '6',
            'hotel_group_id' => '2',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '6',
            'hotel_group_id' => '3',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '7',
            'hotel_group_id' => '6',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '7',
            'hotel_group_id' => '7',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '7',
            'hotel_group_id' => '8',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '8',
            'hotel_group_id' => '8',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '8',
            'hotel_group_id' => '9',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '8',
            'hotel_group_id' => '10',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '9',
            'hotel_group_id' => '9',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '9',
            'hotel_group_id' => '10',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '10',
            'hotel_group_id' => '1',
        ]);
        HotelGroupSelect::create([
            'experience_folder_id' => '10',
            'hotel_group_id' => '2',
        ]);
    }
}
