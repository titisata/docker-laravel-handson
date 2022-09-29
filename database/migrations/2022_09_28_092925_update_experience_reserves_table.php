<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experience_reserves', function($table)
        {
            $table->integer('experience_price_child')->nullable()->after('quantity_adult');
            $table->integer('experience_price_adult')->nullable()->after('experience_price_child');
            $table->integer('hotel_price_child')->nullable()->after('experience_price_adult');
            $table->integer('hotel_price_adult')->nullable()->after('hotel_price_child');
            $table->integer('food_price_child')->nullable()->after('hotel_price_adult');
            $table->integer('food_price_adult')->nullable()->after('food_price_child');
            $table->integer('total_price')->nullable()->after('food_price_adult');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experience_reserves', function($table)
        {
            $table->dropColumn('experience_price_child');
            $table->dropColumn('experience_price_adult');
            $table->dropColumn('hotel_price_child');
            $table->dropColumn('hotel_price_adult');
            $table->dropColumn('food_price_child');
            $table->dropColumn('food_price_adult');
            $table->dropColumn('total_price');
        });
    }
};
