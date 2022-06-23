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
            'goods_id' => 1,
            'user_id' => 1,
            'quantity' => 1,
        ]);
        GoodsOrder::create([
            'goods_id' => 2,
            'user_id' => 1,
            'quantity' => 2,
        ]);
    }
}
