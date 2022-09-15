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
            'name' => 'ランクAホテル',
            'description' => 'とってもよいホテルA！',
            'price_child' => 40000,
            'price_adult' => 50000,
        ]);
        HotelGroup::create([
            'name' => 'ランクBホテル',
            'description' => 'まあまあよいホテルB！',
            'price_child' => 30000,
            'price_adult' => 40000,
        ]);
        HotelGroup::create([
            'name' => 'ランクCホテル',
            'description' => 'とってもよいホテルC！',
            'price_child' => 20000,
            'price_adult' => 30000,
        ]);
        HotelGroup::create([
            'name' => 'ランクDホテル',
            'description' => 'まあまあよいホテルD！',
            'price_child' => 10000,
            'price_adult' => 20000,
        ]);
        HotelGroup::create([
            'name' => 'ランクEホテル',
            'description' => 'とってもよいホテルE！',
            'price_child' => 5000,
            'price_adult' => 10000,
        ]);
        HotelGroup::create([
            'name' => 'ランクFホテル',
            'description' => 'まあまあよいホテルF！',
            'price_child' => 35000,
            'price_adult' => 45000,
        ]);
        HotelGroup::create([
            'name' => 'ランクGホテル',
            'description' => 'とってもよいホテルG！',
            'price_child' => 25000,
            'price_adult' => 35000,
        ]);
        HotelGroup::create([
            'name' => 'ランクHホテル',
            'description' => 'まあまあよいホテルH！',
            'price_child' => 15000,
            'price_adult' => 25000,
        ]);
        HotelGroup::create([
            'name' => 'ランクIホテル',
            'description' => 'とってもよいホテルI！',
            'price_child' => 7500,
            'price_adult' => 15000,
        ]);
        HotelGroup::create([
            'name' => 'ランクJホテル',
            'description' => 'まあまあよいホテルJ！',
            'price_child' => 5000,
            'price_adult' => 7500,
        ]);
    }
}
