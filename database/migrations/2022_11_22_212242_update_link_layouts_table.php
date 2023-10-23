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
        Schema::table('link_layouts', function (Blueprint $table) {
            $table->dropColumn('game_id');
            $table->string('title');
            $table->renameColumn('link', 'content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_layouts', function (Blueprint $table) {
            $table->string('game_id');
            $table->dropColumn('title');
            $table->renameColumn('content', 'link');
        });
    }
};
