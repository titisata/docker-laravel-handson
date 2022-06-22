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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partners');
            $table->foreignId('experience_folder_id')->constrained('experience_folders');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('name', 50);
            $table->string('description', 1000);
            $table->string('category1', 50)->nullable();
            $table->string('category2', 50)->nullable();
            $table->string('category3', 50)->nullable();
            $table->integer('quantity');
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
        Schema::dropIfExists('experiences');
    }
};
