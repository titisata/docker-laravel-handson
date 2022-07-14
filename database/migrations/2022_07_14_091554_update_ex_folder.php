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
        Schema::table('experience_folders', function (Blueprint $table) {
            $table->integer('recommend_flag')->nullable()->index();
            $table->integer('recommend_sort_no')->nullable();
            $table->integer('reserve_flag')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experience_folders', function (Blueprint $table) {
            $table->dropColumn('recommend_flag');
            $table->dropColumn('recommend_sort_no');
            $table->dropColumn('reserve_flag');
        });
    }
};
