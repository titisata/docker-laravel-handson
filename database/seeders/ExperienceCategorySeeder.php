<?php

namespace Database\Seeders;

use App\Models\ExperienceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExperienceCategory::create([
            'name' => '文化'
        ]);
        ExperienceCategory::create([
            'name' => 'アクティビティ'
        ]);
        ExperienceCategory::create([
            'name' => 'その他'
        ]);
    }
}
