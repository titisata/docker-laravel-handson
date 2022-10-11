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
            'status' => '1',
            'delivery_company' => '未確定',
            'delivery_number' => '',
            'from_name' => '一般ユーザ',
            'from_postal_code' =>'000-0033',
            'from_pref_id' =>'14',
            'from_city' =>'サンプルサンプル市',
            'from_town' =>'サンプル7丁目',
            'from_building' =>'ビル1F',
            'from_phone_number' =>'00-0000-0000',
            'to_name' =>'一般ユーザ',
            'to_postal_code' =>'000-0033',
            'to_pref_id' =>'14',
            'to_city' =>'サンプルサンプル市',
            'to_town' =>'サンプル7丁目',
            'to_building' =>'ビル1F',
            'to_phone_number' =>'00-0000-0000',
            'payment_id' => 3487,
        ]);
        GoodsOrder::create([
            'partner_id' => 1,
            'goods_id' => 2,
            'user_id' => 4,
            'quantity' => 2,
            'contact_info' => ' 商品に関する連絡先（株式会社　サンプル）：042-xxxx-xxxx',
            'status' => '1',
            'delivery_company' => '未確定',
            'delivery_number' => '',
            'from_name' => '一般ユーザ',
            'from_postal_code' =>'000-0033',
            'from_pref_id' =>'14',
            'from_city' =>'サンプルサンプル市',
            'from_town' =>'サンプル7丁目',
            'from_building' =>'ビル1F',
            'from_phone_number' =>'00-0000-0000',
            'to_name' =>'一般ユーザ',
            'to_postal_code' =>'000-0033',
            'to_pref_id' =>'14',
            'to_city' =>'サンプルサンプル市',
            'to_town' =>'サンプル7丁目',
            'to_building' =>'ビル1F',
            'to_phone_number' =>'00-0000-0000',
            'payment_id' => 3888,
        ]);
    }
}
