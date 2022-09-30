<?php

namespace Database\Seeders;

use App\Models\GoodsOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodsOrder::create([
            'partner_id' => 1,
            'goods_id' => 1,
            'user_id' => 4,
            'quantity' => 1,
            'contact_info' => '商品に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
        ]);
        GoodsOrder::create([
            'partner_id' => 1,
            'goods_id' => 2,
            'user_id' => 4,
            'quantity' => 2,
            'contact_info' => ' 商品に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
        ]);
    }
}
