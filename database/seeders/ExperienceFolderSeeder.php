<?php

namespace Database\Seeders;

use DateTime;
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
            'description' => 'ラフティング半日ツアー！お得な料金で楽しもう♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 10,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '★時間制限無し★桃食べ放題と畑で桃1個狩り付き',
            'description' => '日本一の桃の里、御坂町で新鮮な桃を食べ放題♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-10day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+10day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 9,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '桃食べ放題と畑で桃20個狩り付き',
            'description' => '日本一の桃の里、御坂町で新鮮な桃を食べ放題♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-10day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+10day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 3,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '日本一の水質！仁淀ブルーの真ん中でクリスタルカヤック（クリアカヤック）体験＆ドローン撮影！',
            'description' => '透明クリスタルカヤック（クリアカヤック）で水と一体化ガイドと一緒に”奇跡の透明度”広大な仁淀ブルーを水上散歩♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 8,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '日本最高の水質！クリスタルカヤック（クリアカヤック）体験＆ドローン撮影！',
            'description' => '最高透明クリスタルカヤック（クリアカヤック）で水と一体化ガイドと一緒に”奇跡の透明度”広大な仁淀ブルーを水上散歩♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => false,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 2,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '急流ラフティング半日ツアー',
            'description' => '急流ラフティング半日ツアー！お得な料金で楽しもう♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 7,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => '激流ラフティング半日ツアー',
            'description' => '激流ラフティング半日ツアー！お得な料金で楽しもう♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 6,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => 'のんびりラフティング半日ツアー',
            'description' => 'のんびりラフティング半日ツアー！お得な料金で楽しもう♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 5,
        ]);
        \App\Models\ExperienceFolder::create([
            'partner_id' => 1,
            'company_id' => 1,
            'name' => 'ゆっくりラフティング半日ツアー',
            'description' => 'ゆっくりラフティング半日ツアー！お得な料金で楽しもう♪テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。テキストをサンプルで入れています。',
            'category1' => 'aa',
            'category2' => 'aa',
            'category3' => null,
            'is_lodging' => true,
            'start_date' => (new DateTime(date('Y-m-d')))->modify('-100day'),
            'end_date' => (new DateTime(date('Y-m-d')))->modify('+50day'),
            'is_before_lodging' => false,
            'price' => 5000,
            'recommend_flag' => 1,
            'recommend_sort_no' => 4,
        ]);
    }
}
