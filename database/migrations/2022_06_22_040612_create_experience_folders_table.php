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
            $table->foreignId('partner_id')->constrained('partners');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('name', 50);
            $table->string('description', 1000);
            $table->string('category1', 50)->nullable();
            $table->string('category2', 50)->nullable();
            $table->string('category3', 50)->nullable();
            $table->boolean('is_lodging'); // 泊りか？
            $table->boolean('is_before_lodging'); // 前泊か？
            $table->integer('price');
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
