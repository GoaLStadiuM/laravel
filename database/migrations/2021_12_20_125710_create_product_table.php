<?php

use Database\Seeders\ProductSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedTinyInteger('division');
            $table->unsignedTinyInteger('level');
            $table->unsignedSmallInteger('price');
            $table->string('video_url');
            $table->string('img_url');
            $table->timestamps();
        });

        (new ProductSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
