<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personajuridica_id');
            $table->unsignedBigInteger('nivel_id');
            $table->enum('estado',[0,1])->default(1);

            $table->foreign('personajuridica_id')->references('id')->on('personasjuridicas');
            $table->foreign('nivel_id')->references('id')->on('provider_nivel');
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
        Schema::dropIfExists('providers');
    }
}
