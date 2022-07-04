<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => 'ラフティング半日ツアー',
            'description' => 'ラフティング半日ツアー！お得な料金で楽しもう♪',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'is_before_lodging' => true,
            'price' => 5000,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '★時間制限無し★桃食べ放題と畑で桃1個狩り付き',
            'description' => '日本一の桃の里、御坂町で新鮮な桃を食べ放題♪',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'is_before_lodging' => false,
            'price' => 5000,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '日本一の水質！仁淀ブルーの真ん中でクリスタルカヤック（クリアカヤック）体験＆ドローン撮影！',
            'description' => '透明クリスタルカヤック（クリアカヤック）で水と一体化ガイドと一緒に”奇跡の透明度”広大な仁淀ブルーを水上散歩♪',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'is_before_lodging' => false,
            'price' => 5000,
        ]);
    }
}
