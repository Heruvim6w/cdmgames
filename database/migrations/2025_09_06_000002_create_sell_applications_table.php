<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sell_applications', function (Blueprint $table) {
            $table->id();
            $table->string('telegram');
            $table->unsignedBigInteger('game_id');
            $table->text('description');
            $table->json('media')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sell_applications');
    }
};

