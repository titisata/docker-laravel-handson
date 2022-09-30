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
            $table->foreignId('partner_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('experience_id')->constrained('experiences');
            $table->foreignId('hotel_group_id')->nullable()->constrained('hotel_groups');
            $table->foreignId('food_group_id')->nullable()->constrained('food_groups');
            $table->foreignId('hotel_id')->nullable()->constrained('hotels');
            $table->foreignId('food_id')->nullable()->constrained('foods');
            $table->string('comment');
            $table->string('status');
            $table->integer('quantity_child');
            $table->integer('quantity_adult');
            $table->string('message');
            $table->string('contact_info', 1000);
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
