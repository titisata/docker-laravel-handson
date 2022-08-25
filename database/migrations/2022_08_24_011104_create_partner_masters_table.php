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
        Schema::create('partner_masters', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name',50);
            $table->boolean('reserve_flag');
            $table->integer('service');
            $table->integer('regist_num');
            $table->string('comment',1000);
            $table->string('main_image');
            $table->string('site_color');
            $table->string('sales_copy',100);
            $table->string('address',150);
            $table->string('phone');
            $table->string('access', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_masters');
    }
};
