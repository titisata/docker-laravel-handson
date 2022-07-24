<?php

namespace Database\Seeders;

use App\Models\GoodsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodsCategory::create([
            'name' => '食べ物'
        ]);
        GoodsCategory::create([
            'name' => '飲み物'
        ]);
        GoodsCategory::create([
            'name' => '雑貨'
        ]);
    }
}
