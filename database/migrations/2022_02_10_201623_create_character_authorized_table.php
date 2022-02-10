<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterAuthorizedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_authorized', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authorized_id');
            $table->unsignedBigInteger('character_id');
            $table->timestamps();

            $table->foreign('authorized_id')->references('id')->on('user');
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
        Schema::dropIfExists('character_authorized');
    }
}
