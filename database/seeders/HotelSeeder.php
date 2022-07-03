<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
            'hotel_group_id' => 1,
            'name' => '極上ホテルA',
            'description' => 'とってもいいホテルAです！',
        ]);
        Hotel::create([
            'hotel_group_id' => 1,
            'name' => '極上ホテルB',
            'description' => 'とってもいいホテルBです！',
        ]);
        Hotel::create([
            'hotel_group_id' => 2,
            'name' => '通常ホテルA',
            'description' => 'まあまあいいホテルAです！',
        ]);
        Hotel::create([
            'hotel_group_id' => 2,
            'name' => '通常ホテルB',
            'description' => 'まあまあいいホテルBです！',
        ]);
    }
}
