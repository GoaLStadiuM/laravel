<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('title');
            $table->string('email');
            $table->unsignedSmallInteger('amount');
            $table->unsignedMediumInteger('share');
            $table->string('wallet');
            $table->string('country_code');
            $table->unsignedSmallInteger('entity_id');
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influencer');
    }
}
