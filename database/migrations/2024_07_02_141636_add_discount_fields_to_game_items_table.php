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
        Schema::table('game_items', function (Blueprint $table) {
            $table->integer('discount')->nullable();
            $table->string('discount_description')->nullable();
            $table->boolean('is_discount')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_items', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('discount_description');
            $table->dropColumn('is_discount');
        });
    }
};
