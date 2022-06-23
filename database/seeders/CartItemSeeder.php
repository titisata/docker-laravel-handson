<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartItem::create([
            'goods_id' => 1,
            'user_id' => 1,
            'quantity' => 1,
        ]);
        CartItem::create([
            'goods_id' => 2,
            'user_id' => 1,
            'quantity' => 3,
        ]);
    }
}
