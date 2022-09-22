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
        ]);
        GoodsOrder::create([
            'partner_id' => 1,
            'goods_id' => 2,
            'user_id' => 4,
            'quantity' => 2,
        ]);
    }
}
