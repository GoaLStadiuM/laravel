<?php

use Database\Seeders\StakingOptionSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakingOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staking_option', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('vesting_period')->unique();
            $table->unsignedSmallInteger('bonus_percentage');
            $table->timestamps();
        });

        (new StakingOptionSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staking_option');
    }
}
