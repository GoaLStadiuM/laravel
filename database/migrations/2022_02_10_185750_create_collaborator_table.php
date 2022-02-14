<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborator', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('type_id');
            $table->unsignedSmallInteger('amount');
            $table->string('country_code');
            $table->unsignedSmallInteger('entity_id');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('entity_type');
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
        Schema::dropIfExists('collaborator');
    }
}
