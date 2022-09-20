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
        Schema::create('hotel_group_selects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_folder_id')->constrained('experience_folders');
            $table->foreignId('hotel_group_id')->constrained('hotel_groups');
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
        Schema::dropIfExists('hotel_group_selects');
    }
};
