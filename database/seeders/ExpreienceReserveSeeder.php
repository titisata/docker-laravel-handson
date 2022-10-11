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
            'partner_id' => 1,
            'user_id' => 1,
            'experience_id' => 1,
            'hotel_group_id' => 1,
            'food_group_id' => 1,
            'hotel_id' => 1,
            'food_id' => 1,
            'comment' => 'テスト1',
            'status' => '1',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'contact_info' => 'キャンセル時の連絡先(oo観光協会)：04-xxx-xxx 体験に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'payment_id' => 1234,
        ]);
        ExperienceReserve::create([
            'partner_id' => 1,
            'user_id' => 1,
            'experience_id' => 1,
            'hotel_group_id' => 1,
            'food_group_id' => null,
            'hotel_id' => 1,
            'food_id' => null,
            'comment' => 'テスト2',
            'status' => '1',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'contact_info' => 'キャンセル時の連絡先(oo観光協会)：04-xxx-xxx 体験に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'payment_id' => 2345,
        ]);

        ExperienceReserve::create([
            'partner_id' => 3,
            'user_id' => 2,
            'experience_id' => 20,
            'hotel_group_id' => null,
            'food_group_id' => null,
            'hotel_id' => null,
            'food_id' => null,
            'comment' => 'テスト3',
            'status' => '1',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'contact_info' => 'キャンセル時の連絡先(oo観光協会)：04-xxx-xxx 体験に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'payment_id' => 5678,
        ]);

        ExperienceReserve::create([
            'partner_id' => 3,
            'user_id' => 4,
            'experience_id' => 20,
            'hotel_group_id' => null,
            'food_group_id' => null,
            'hotel_id' => null,
            'food_id' => null,
            'comment' => 'テスト3',
            'status' => '1',
            'message' => 'テスト的なお店へのメッセージです。テスト。',
            'contact_info' => 'キャンセル時の連絡先(oo観光協会)：04-xxx-xxx 体験に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
            'quantity_child' => 1,
            'quantity_adult' => 1,
            'start_date' =>  date('Y-m-d'),
            'end_date' =>  date('Y-m-d'),
            'payment_id' => 8945,
        ]);
    }
}
