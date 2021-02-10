<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexTipoDetalle', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',30);
            $table->timestamps();
        });

        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('talla_id');
            $table->unsignedBigInteger('color_id');
            $table->bigInteger('stockFisico')->default(0);
            $table->bigInteger('stockDisponible')->default(0);

            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('talla_id')->references('id')->on('tallas');
            


            $table->timestamps();
        });

        Schema::create('kardexDetalle', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kardex_id');
            $table->unsignedBigInteger('tipo_id');
            $table->date('fecha');
            $table->bigInteger('cantidad');
            $table->text('motivo');

            $table->foreign('tipo_id')->references('id')->on('kardexTipoDetalle');

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
        Schema::dropIfExists('kardexes');
    }
}
