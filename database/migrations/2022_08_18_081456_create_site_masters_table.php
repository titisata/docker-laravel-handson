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
        Schema::create('site_masters', function (Blueprint $table) {
            $table->id();
            $table->string('site_name',100);
            $table->boolean('open_flag')->nullable();
            $table->integer('service')->nullable();
            $table->integer('shop_num')->nullable();
            $table->integer('regist_num')->nullable();
            $table->integer('recommend_limit')->nullable();
            $table->string('comment',1000);
            $table->string('main_image');
            $table->string('site_color',10)->nullable();
            $table->string('sales_copy',1000);
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
        Schema::dropIfExists('site_masters');
    }
};
