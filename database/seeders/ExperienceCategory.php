<?php

namespace Database\Seeders;

use App\Models\ExperienceCategory as ModelsExperienceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsExperienceCategory::create([
            'name' => '文化'
        ]);
        ModelsExperienceCategory::create([
            'name' => 'アクティビティ'
        ]);
        ModelsExperienceCategory::create([
            'name' => 'その他'
        ]);
    }
}
