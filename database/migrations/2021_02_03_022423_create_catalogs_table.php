<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->text('nombre',100);
            $table->text('slug',100)->nullable();
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->unsignedBigInteger('type_id');
            $table->enum('estado',[0,1])->default(1);

            $table->foreign('type_id')->references('id')->on('catalog_types');

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
        Schema::dropIfExists('catalogs');
    }
}
