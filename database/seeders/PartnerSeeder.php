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
            'name' => 'パートナーA',
            'description' => 'パートナーAはテスト的なテストです！',
            'reserve_flag' => true,
            'service' => '0',
            'regist_num' => '0',
            'background_color' => 'FFFFFF',
            'catch_copy' => '天然水が導く魅惑の都市。',
            'access' => '斎川町駅より徒歩15分です。ご連絡いただければ車でお迎えにまいります。',
            'address' => '千葉県木更津市北浜町１',
            'phone' => '042-xxxx-xxxx',
        ]);

        
    }
}
