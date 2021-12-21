<?php

use Database\Seeders\TrainingSessionSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_session', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 15);
            $table->unsignedTinyInteger('max_hours');
            $table->timestamps();
        });

        (new TrainingSessionSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_session');
    }
}
