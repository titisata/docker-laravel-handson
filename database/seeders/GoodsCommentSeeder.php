<?php

namespace Database\Seeders;

use App\Models\GoodsComment;
use App\Models\GoodsFolder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        GoodsComment::create([
            'user_id' => 1,
            'goods_folder_id' => 1,
            'content' => 'こんにちは',
            'rate' => 4,
        ]);
        
        GoodsComment::create([
            'user_id' => 1,
            'goods_folder_id' => 2,
            'content' => 'こんにちは!!!',
            'rate' => 4,
        ]);
        
        GoodsComment::create([
            'user_id' => 1,
            'goods_folder_id' => 3,
            'content' => 'こんにちは',
            'rate' => 4,
        ]);
        
        $folders = GoodsFolder::all();
        foreach ($folders as $folder) {
            $goods_folder_id = $folder->id;
            $average_rate = GoodsComment::where('goods_folder_id', $goods_folder_id)->avg('rate');
            GoodsFolder::where('id', $goods_folder_id)->update(['average_rate' => $average_rate ?? 0]);
        }
    }
}
