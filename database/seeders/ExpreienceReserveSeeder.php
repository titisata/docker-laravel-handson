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
            'hotel_group_id' => 1,
            'food_group_id' => 1,
            'hotel_id' => 1,
            'food_id' => 1,
            'comment' => 'テスト1',
            'status' => '済み',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
        ]);
        ExperienceReserve::create([
            'user_id' => 1,
            'experience_id' => 1,
            'hotel_group_id' => 1,
            'food_group_id' => null,
            'hotel_id' => 1,
            'food_id' => null,
            'comment' => 'テスト2',
            'status' => '済み',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
        ]);
    }
}
