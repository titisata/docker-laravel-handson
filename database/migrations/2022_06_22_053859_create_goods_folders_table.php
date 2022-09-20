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
        Schema::create('goods_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users');
            $table->string('name', 50)->index();
            $table->string('description', 1000);
            $table->string('caution', 1000);
            $table->string('detail', 1000);
            $table->string('category1', 50)->nullable()->index();
            $table->string('category2', 50)->nullable()->index();
            $table->string('category3', 50)->nullable()->index();
            $table->integer('recommend_flag')->nullable()->index();
            $table->integer('recommend_sort_no')->nullable();
            $table->float('average_rate')->default(0);
            $table->integer('price')->index();
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
        Schema::dropIfExists('goods_folders');
    }
};
