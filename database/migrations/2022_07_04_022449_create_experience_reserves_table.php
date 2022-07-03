<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_reserves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('experience_id')->constrained('experiences');
            $table->foreignId('hotel_group_id')->constrained('hotel_groups')->nullable();
            $table->foreignId('food_group_id')->constrained('food_groups')->nullable();
            $table->foreignId('hotel_id')->constrained('hotels')->nullable();
            $table->foreignId('food_id')->constrained('foods')->nullable();
            $table->string('comment');
            $table->string('status');
            $table->string('place_detail');
            $table->integer('child_num');
            $table->integer('adult_num');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
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
        Schema::dropIfExists('experience_reserves');
    }
};
