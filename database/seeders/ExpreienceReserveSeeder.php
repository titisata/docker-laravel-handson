<?php

namespace Database\Seeders;

use App\Models\ExperienceReserve;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ExpreienceReserveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExperienceReserve::create([
            'user_id' => 1,
            'experience_id' => 1,
            'comment' => 'test1',
            'place_detail' => 'ほげ1',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
        ]);
        ExperienceReserve::create([
            'user_id' => 1,
            'experience_id' => 2,
            'comment' => 'test2',
            'place_detail' => 'ほげ2',
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
        ]);
    }
}
