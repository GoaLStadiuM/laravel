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
            $table->unsignedBigInteger('payment_id');
            $table->string('name', 15)->nullable();
            $table->unsignedTinyInteger('division');
            $table->unsignedTinyInteger('level');
            $table->decimal('strength', 5, 2);
            $table->decimal('accuracy', 5, 2);
            $table->unsignedSmallInteger('xp')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('base_id')->references('id')->on('base_character');
            $table->foreign('payment_id')->references('id')->on('nft_payment');
            $table->foreign('division', 'character_division_kicks_per_division_foreign')->references('division')->on('kicks_per_division');
            $table->foreign('division', 'character_division_xp_for_level_foreign')->references('division')->on('xp_for_level');
            $table->foreign('level')->references('level')->on('xp_for_level');
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
