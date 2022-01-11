<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kick', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_id');
            $table->boolean('result');
            $table->decimal('reward', 16, 7)->nullable();
            $table->timestamps();

            $table->foreign('character_id')->references('id')->on('character');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kick');
    }
}
