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
        Schema::create('goods_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users');
            $table->foreignId('goods_id')->constrained('goods');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('quantity');
            $table->string('contact_info', 1000);
            $table->string('status');
            $table->string('from_name');
            $table->string('from_postal_code');
            $table->integer('from_pref_id');
            $table->string('from_city');
            $table->string('from_town');
            $table->string('from_building')->nullable();;
            $table->string('from_phone_number');
            $table->string('to_name');
            $table->string('to_postal_code');
            $table->integer('to_pref_id');
            $table->string('to_city');
            $table->string('to_town');
            $table->string('to_building')->nullable();;
            $table->string('to_phone_number');
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
        Schema::dropIfExists('goods_orders');
    }
};
