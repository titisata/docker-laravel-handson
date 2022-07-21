<?php

namespace Database\Seeders;

use App\Models\GoodsFolder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => '白い恋人 (test)',
            'description' => '北海道のおいしいお土産テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'food',
            'category2' => 'aa',
            'category3' => null,
            'price' => 100,
            'recommend_flag' => 1,
            'recommend_sort_no' => 10,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => '信州そば (test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'food',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 9,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 8,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 7,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => '白い恋人 (test)',
            'description' => '北海道のおいしいお土産テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'food',
            'category2' => 'aa',
            'category3' => null,
            'price' => 100,
            'recommend_flag' => 1,
            'recommend_sort_no' => 6,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => '信州そば (test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'food',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 5,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 4,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 3,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'カルピス (test)',
            'description' => '乳酸菌飲料と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'drink',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 2,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 1,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 11,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 12,
        ]);
        GoodsFolder::create([
            'partner_id' => 1,
            'name' => 'こけし(test)',
            'description' => '信州と言ったらこれ！テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'goods',
            'category2' => null,
            'category3' => null,
            'price' => 500,
            'recommend_flag' => 1,
            'recommend_sort_no' => 13,
        ]);
    }
}
