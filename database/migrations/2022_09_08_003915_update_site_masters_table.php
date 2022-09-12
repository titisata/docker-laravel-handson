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
        Schema::table('site_masters', function (Blueprint $table) {
            $table->string('site_name',100)->nullable()->change();
            $table->boolean('open_flag')->nullable()->change();
            $table->integer('service')->nullable()->change();
            $table->integer('shop_num')->nullable()->change();
            $table->integer('regist_num')->nullable()->change();
            $table->integer('recommend_limit')->nullable()->change();
            $table->string('comment',1000)->nullable()->change();
            $table->string('site_color',10)->nullable()->change();
            $table->string('sales_copy',1000)->nullable()->change();
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
        Schema::table('site_masters', function (Blueprint $table) {
            $table->string('site_name',100);
            $table->boolean('open_flag');
            $table->integer('service');
            $table->integer('shop_num');
            $table->integer('regist_num');
            $table->integer('recommend_limit');
            $table->string('comment',1000);
            $table->string('site_color',10);
            $table->string('sales_copy',1000);
        });
    }
};
