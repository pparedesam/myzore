<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',30)->nullable();
            $table->string('nombre',100);
            $table->string('descripcion',500);
            $table->string('codigoProveedor',100)->nullable();


            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('genero_id');
            $table->unsignedBigInteger('material_id');
            
            
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->foreign('material_id')->references('id')->on('materials');

            $table->bigInteger('stock')->default('0');

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
        Schema::dropIfExists('productos');
    }
}
