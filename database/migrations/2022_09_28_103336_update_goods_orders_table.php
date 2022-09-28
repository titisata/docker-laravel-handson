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
        Schema::table('goods_orders', function($table)
        {
            $table->integer('goods_price')->nullable()->after('quantity');
            $table->integer('total_price')->nullable()->after('goods_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_orders', function($table)
        {
            $table->dropColumn('goods_price');
            $table->dropColumn('total_price');
        });
    }
};
