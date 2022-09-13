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
        Schema::table('partners', function (Blueprint $table) {
            $table->string('description', 1000)->nullable()->change();
            $table->string('background_color')->nullable()->change();
            $table->string('catch_copy')->nullable()->change();
            $table->string('access', 1000)->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->boolean('reserve_flag')->nullable()->change();
            $table->integer('service')->nullable()->change();
            $table->integer('regist_num')->nullable()->change();
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
        Schema::table('partners', function (Blueprint $table) {
            $table->string('description', 1000);
            $table->string('background_color');
            $table->string('catch_copy');
            $table->string('access', 1000);
            $table->string('address');
            $table->string('phone');
            $table->boolean('reserve_flag');
            $table->integer('service');
            $table->integer('regist_num');
        });
    }
};
