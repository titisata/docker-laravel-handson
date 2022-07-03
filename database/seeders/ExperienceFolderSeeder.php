<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => 'test_ex2',
            'description' => 'hoge',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => '',
            'is_before_lodging' => '',
            'price' => 5000,
        ]);
    }
}
