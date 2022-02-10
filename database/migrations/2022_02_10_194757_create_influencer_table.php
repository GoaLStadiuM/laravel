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
            $table->unsignedTinyInteger('type_id');
            $table->string('email');
            $table->unsignedSmallInteger('amount');
            $table->unsignedMediumInteger('share');
            $table->string('country_code');
            $table->unsignedSmallInteger('person_id');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('person_type');
            $table->foreign('person_id')->references('id')->on('person');
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
