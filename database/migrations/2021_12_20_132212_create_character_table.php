<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('base_id');
            $table->string('name', 15)->nullable();
            $table->decimal('strength', 5, 2);
            $table->decimal('accuracy', 5, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('base_id')->references('id')->on('base_character');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character');
    }
}
