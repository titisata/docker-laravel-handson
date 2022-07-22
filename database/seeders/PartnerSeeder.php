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
            'user_id' => 1,
            'name' => 'ホテル三日月',
            'description' => 'ホテル三日月はテスト的なテストです！',
            'background_color' => 'FFFFFF',
            'catch_copy' => '天然水が導く魅惑の都市。',
            'access' => '斎川町駅より徒歩15分です。ご連絡いただければ車でお迎えにまいります。',
            'address' => '長野県大和市斎川町200-5',
            'phone' => '042-xxxx-xxxx',
        ]);
    }
}
