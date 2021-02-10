<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products', function (Blueprint $table) {

            $table->unsignedBigInteger('catalog_id');
            $table->unsignedBigInteger('product_id');
            $table->double('precioventa');
            $table->enum('estado',[0,1])->default(1);

            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('product_id')->references('id')->on('productos');
            $table->primary(['catalog_id','product_id']);
            $table->timestamps();
        });

        Schema::create('catalog_products_color', function (Blueprint $table) {

            $table->unsignedBigInteger('catalog_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');

            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('product_id')->references('id')->on('productos');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->primary(['catalog_id','product_id','color_id'],'catalog_colors_id_primary');
            $table->timestamps();
        });

        Schema::create('catalog_products_colors_tallas', function (Blueprint $table) {

            $table->unsignedBigInteger('catalog_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('talla_id');

            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('product_id')->references('id')->on('productos');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('talla_id')->references('id')->on('tallas');
            $table->primary(['catalog_id','product_id','color_id','talla_id'],'catalog_tallas_id_primary');
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
        Schema::dropIfExists('catalog_products');
        Schema::dropIfExists('catalog_products_color');
        Schema::dropIfExists('catalog_products_colors_tallas');
    }
}
