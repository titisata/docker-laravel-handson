<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Models\PartnerMaster::create([
            'partner_num'=>'田中商店',
            'reserve_flag'=>1,
            'service'=>0,
            'regist_num'=>0,
            'comment'=>'田中商店で楽しい時間を！！',
            'main_image'=>'',
            'site_color'=>'',
            'sales_copy'=>'田中商店です！！！',
            'address'=>'',
            'phone'=>'',
            'access'=>'',
        ]);
    }
}
