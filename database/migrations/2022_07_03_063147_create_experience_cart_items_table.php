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
        Schema::create('experience_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')->constrained('experiences');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('hotel_group_id')->nullable()->constrained('hotel_groups');
            $table->foreignId('food_group_id')->nullable()->constrained('food_groups');
            $table->integer('quantity_child');
            $table->integer('quantity_adult');
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
        Schema::dropIfExists('experience_cart_items');
    }
};
