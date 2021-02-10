<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoImagesType', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20);
           
            $table->timestamps();
        });

        Schema::create('productoImagenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('imageType_id');
            $table->string('nombreImageColor',200);
            $table->string('url',200);

            $table->foreign('imageType_id')->references('id')->on('productoImagesType');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productoImagesType');
        Schema::dropIfExists('productoImagenes');
    }
}
