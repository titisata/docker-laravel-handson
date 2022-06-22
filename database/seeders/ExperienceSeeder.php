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
            'partner_id' => 1,
            'experience_folder_id' => 1,
            'company_id' => 1,
            'name' => 'test_ex1',
            'description' => 'hoge',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 5000,
        ]);
        \App\Models\Experience::create([
            'partner_id' => 1,
            'experience_folder_id' => 1,
            'company_id' => 1,
            'name' => 'test_ex2',
            'description' => 'hoge',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 5000,
        ]);
    }
}
