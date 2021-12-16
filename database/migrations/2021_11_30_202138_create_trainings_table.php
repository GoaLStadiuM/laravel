<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->UnsignedInteger('user_id');
            $table->unsignedInteger('player_id');
            $table->dateTime('endTime');
            $table->unsignedInteger('training_type')->default(1);
            $table->boolean('done')->default(false);
            $table->string('idle_url')->nullable();
            $table->string('training1_url')->nullable();
            $table->string('training2_url')->nullable();
            $table->string('training3_url')->nullable();
            $table->string('training4_url')->nullable();
            $table->timestamps();
        });
        Schema::table('payments', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
