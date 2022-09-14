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
        Schema::table('hotel_selects', function (Blueprint $table) {
            
            $table->dropForeign('hotel_selectss_hotel_id_foreign');
            $table->dropColumn('hotel_id');
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
        Schema::table('hotel_selects', function (Blueprint $table) {
            $table->foreignId('hotel_id')->constrained('hotels');
        });
    }
};
