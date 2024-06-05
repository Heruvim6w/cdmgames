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
        Schema::create('game_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_for_item_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', unsigned: true);
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->foreign('game_for_item_id')
                ->references('id')
                ->on('game_for_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_items');
    }
};
