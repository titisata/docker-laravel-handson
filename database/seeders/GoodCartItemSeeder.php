<?php

namespace Database\Seeders;

use App\Models\GoodCartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodCartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodCartItem::create([
            'partner_id' => 1,
            'goods_id' => 1,
            'user_id' => 4,
            'quantity' => 1,
        ]);
        GoodCartItem::create([
            'partner_id' => 1,
            'goods_id' => 2,
            'user_id' => 4,
            'quantity' => 3,
        ]);
    }
}
