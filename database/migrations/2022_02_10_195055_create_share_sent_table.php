<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareSentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_sent', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('share_amount');
            $table->string('tx_hash');
            $table->unsignedSmallInteger('person_id');
            $table->timestamps();

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
        Schema::dropIfExists('share_sent');
    }
}
