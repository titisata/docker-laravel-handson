<?php

namespace Database\Seeders;

use App\Models\Goods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goods::create([
            'partner_id' => 1,
            'name' => '白い恋人 12個入り(test)',
            'description' => '北海道のおいしいお土産',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 100,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => '信州そば 4人前(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'aaaa',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
        ]);
    }
}
