<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Partner::create([
            'user_id' => 4,
            'name' => 'aaaa',
            'main_image' => 'aaaa',
            'background_color' => 'aaa',
            'catch_copy' => 'aaa',
            'address' => 'aaa',
            'phone' => 'aaa',
        ]);
    }
}
