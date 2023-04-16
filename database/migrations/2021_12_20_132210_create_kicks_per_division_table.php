<?php

use Database\Seeders\KicksPerDivisionSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKicksPerDivisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kicks_per_division', function (Blueprint $table) {
            $table->tinyIncrements('division');
            $table->unsignedTinyInteger('kicks')->unique();
            $table->timestamps();
        });

        (new KicksPerDivisionSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kicks_per_division');
    }
}
