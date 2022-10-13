<?php

namespace Database\Seeders;

use App\Models\HotelSelect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HotelSelect::create([
            'hotel_group_id' => '1',
            'hotel_id' => '1',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '2',
            'hotel_id' => '1',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '3',
            'hotel_id' => '1',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '4',
            'hotel_id' => '1',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '5',
            'hotel_id' => '1',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '1',
            'hotel_id' => '2',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '2',
            'hotel_id' => '2',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '3',
            'hotel_id' => '2',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '4',
            'hotel_id' => '2',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '5',
            'hotel_id' => '2',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '6',
            'hotel_id' => '3',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '7',
            'hotel_id' => '3',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '8',
            'hotel_id' => '3',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '9',
            'hotel_id' => '3',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '10',
            'hotel_id' => '3',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '6',
            'hotel_id' => '4',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '7',
            'hotel_id' => '4',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '8',
            'hotel_id' => '4',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '9',
            'hotel_id' => '4',
        ]);
        HotelSelect::create([
            'hotel_group_id' => '10',
            'hotel_id' => '4',
        ]);
    }
}
