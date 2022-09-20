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
        //
        Schema::table('hotels', function (Blueprint $table) { 
            $table->dropForeign('hotels_hotel_group_id_foreign');
            $table->dropColumn('hotel_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('hotels', function (Blueprint $table) { 
            $table->foreignId('hotel_group_id')->constrained('hotel_groups');
        });
    }
};
