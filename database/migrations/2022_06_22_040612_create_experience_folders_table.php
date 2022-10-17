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
        Schema::create('experience_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('name', 50)->index();
            $table->string('description', 1000);
            $table->string('address', 1000);
            $table->string('phone', 1000);
            $table->string('caution', 1000);
            $table->string('detail', 1000);
            $table->string('category1', 50)->nullable()->index();
            $table->string('category2', 50)->nullable()->index();
            $table->string('category3', 50)->nullable()->index();
            $table->boolean('is_lodging'); // 泊りか？
            $table->boolean('is_before_lodging'); // 前泊か？
            $table->boolean('close_date')->default(1);; // 手じまい日入力欄
            $table->integer('price_child')->index();
            $table->integer('price_adult')->index();
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
        Schema::dropIfExists('experience_folders');
    }
};
