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
        //
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('mail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('mail');
            
        });
    }
};
