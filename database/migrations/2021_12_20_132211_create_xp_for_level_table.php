<?php

use Database\Seeders\XpForLevelSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXpForLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xp_for_level', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('division');
            $table->unsignedTinyInteger('level');
            $table->unsignedSmallInteger('xp_for_next_level');
            $table->timestamps();

            $table->unique(['division', 'level']);
        });

        (new XpForLevelSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xp_for_level');
    }
}
