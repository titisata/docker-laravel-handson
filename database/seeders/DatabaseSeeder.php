<?php

namespace Database\Seeders;

use App\Models\ExperienceReserve;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        $databaseName = DB::getDatabaseName();
        $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        foreach ($tables as $table) {
            $name = $table->TABLE_NAME;
            //if you don't want to truncate migrations
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }
        DB::statement("SET foreign_key_checks=1");

        $this->call(UserSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ExperienceFolderSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(GoodsFolderSeeder::class);
        $this->call(GoodsSeeder::class);
        $this->call(GoodsOrderSeeder::class);
        $this->call(FoodGroupSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(HotelGroupSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(GoodCartItemSeeder::class);
        $this->call(ExperienceCartItemSeeder::class);
        $this->call(ExpreienceReserveSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ExperienceCommentSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ExperienceCategorySeeder::class);
        $this->call(GoodsCategorySeeder::class);
    }
}
