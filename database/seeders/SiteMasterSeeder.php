<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        \App\Models\SiteMaster::create([
            'site_name' => 'サンプル観光協会',
            'open_flag' => 1,
            'service' => 0,
            'shop_num' => 0,
            'regist_num' => 0,
            'recommend_limit' => 10,
            'comment' => 'サンプル町が設定できる文章です。この文章はサンプルです。この文章はサンプルです。この文章はサンプルです。',
            'main_image' => '',
            'site_color' => '',
            'sales_copy' => 'サンプル町で楽しく過ごそう！',
        ]);

    }
}
