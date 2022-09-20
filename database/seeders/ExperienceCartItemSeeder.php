<?php

namespace Database\Seeders;

use App\Models\ExperienceCartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceCartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExperienceCartItem::create([
            'partner_id' => 1,
            'experience_id' => 1,
            'user_id' => 1,
            'hotel_group_id' => 1,
            'food_group_id' => 1,
            'message' => 'カニアレルギーなので、カニは省いてほしいです。',
            'quantity_child' => 1,
            'quantity_adult' => 1,
        ]);
    }
}
