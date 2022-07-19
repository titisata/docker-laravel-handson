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
            'category1' => 'food',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 100,
            'recommend_flag' => 1,
            'recommend_sort_no' => 10,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => '信州そば 4人前(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'food',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 9,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 8,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 7,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => '白い恋人 12個入り(test)',
            'description' => '北海道のおいしいお土産',
            'category1' => 'food',
            'category2' => 'aa',
            'category3' => null,
            'quantity' => 5,
            'price' => 100,
            'recommend_flag' => 1,
            'recommend_sort_no' => 6,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => '信州そば 4人前(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'food',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 5,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 4,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 3,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 2,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 1,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 11,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 12,
        ]);
        Goods::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'quantity' => 5,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 13,
        ]);
    }
}
