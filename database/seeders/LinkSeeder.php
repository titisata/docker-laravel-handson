<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Link::create([
            'name' => '利用規約',
            'content' => '利用規約',
        ]);

        Link::create([
            'name' => 'プライバシー規約',
            'content' => 'プライバシー規約',
        ]);

        Link::create([
            'name' => '特定証取引に基づく表示',
            'content' => '特定証取引に基づく表示',
        ]);

        Link::create([
            'name' => '店舗情報',
            'content' => '店舗情報',
        ]);

        Link::create([
            'name' => 'ヘルプ・マニュアル',
            'content' => 'ヘルプ・マニュアル',
        ]);

    }
}
