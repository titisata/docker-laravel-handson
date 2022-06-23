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
            'name' => 'test_good1',
            'description' => 'hoge',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 100,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'test_good2',
            'description' => 'aahoge',
            'category1' => 'aaaa',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
        ]);
    }
}
