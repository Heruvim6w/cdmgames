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
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'attachment')) {
                $table->string('attachment')->nullable()->after('vk_user_avatar');
            }
            $table->string('tg_user_name')->nullable();
            $table->string('tg_comment_link')->nullable();
            $table->string('vk_user_id')->nullable()->change();
            $table->integer('comment_id')->nullable()->change();
            $table->string('vk_user_name')->nullable()->change();
            $table->string('vk_user_avatar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('tg_user_name');
            $table->dropColumn('tg_comment_link');
            $table->string('vk_user_id')->nullable(false)->change();
            $table->integer('comment_id')->nullable(false)->change();
            $table->string('vk_user_name')->nullable(false)->change();
            $table->string('vk_user_avatar')->nullable(false)->change();

        });
    }
};
