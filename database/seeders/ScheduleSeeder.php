<?php

namespace Database\Seeders;

use App\Models\Schedule;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'partner_id' => 1,
            'experience_folder_id' => 1,
            'date' => (new DateTime(date('Y-m-d')))->modify('-5day'),
            'is_holiday' => 1,
            'quantity' => null,
            'title' => 'お休み',
            'comment' => '台風の接近により当日は休館とさせていただきます。',
        ]);
        Schedule::create([
            'partner_id' => 1,
            'experience_folder_id' => 1,
            'date' => (new DateTime(date('Y-m-d')))->modify('-4day'),
            'is_holiday' => 1,
            'quantity' => null,
            'title' => 'お休み',
            'comment' => '台風の接近により当日は休館とさせていただきます。',
        ]);
        Schedule::create([
            'partner_id' => 1,
            'experience_folder_id' => 1,
            'date' => (new DateTime(date('Y-m-d')))->modify('-3day'),
            'is_holiday' => 1,
            'quantity' => null,
            'title' => 'お休み',
            'comment' => '台風の接近により当日は休館とさせていただきます。',
        ]);
    }
}
