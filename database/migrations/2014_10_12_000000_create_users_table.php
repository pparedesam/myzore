<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sexos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20);

            $table->timestamps();
        });

        Schema::create('estado_civil', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20);

            $table->timestamps();
        });

        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20);

            $table->timestamps();
        });

         Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('telefono',20)->nullable();
            
            
            $table->unsignedBigInteger('documento_id');
            $table->string('nroDocumento',20)->nullable();
            $table->string('email')->nullable();

            $table->string('direccion',100)->nullable();
            $table->string('referenciaDireccion',100)->nullable();
            $table->string('region_id');
            $table->string('provincia_id');
            $table->string('distrito_id');

            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('distrito_id')->references('id')->on('distritos');

            $table->timestamps();
        });
        
        Schema::create('PersonasJuridicas', function (Blueprint $table) {
            $table->id();
            $table->string('razonSocial',100)->nullable();
            $table->string('personaContacto',100)->nullable();
            $table->enum('estado',[0,1])->default(1);

            $table->unsignedBigInteger('persona_id');

            $table->foreign('persona_id')->references('id')->on('personas');

            $table->timestamps();
        });

        Schema::create('PersonasNaturales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id');
            $table->string('primerApellido',50);
            $table->string('segundoApellido',50);
            $table->string('nombres',50);

            $table->unsignedBigInteger('documento_id');
            $table->string('nroDocumento',50)->unique();
            $table->date('fechaNacimiento');

            $table->string('nroWhatsapp',50)->nullable();
            
            $table->unsignedBigInteger('sexo_id');
            $table->unsignedBigInteger('estacoCivil_id');
            
            

            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->foreign('estacoCivil_id')->references('id')->on('estado_civil');

            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->unsignedBigInteger('persona_id');
            $table->enum('estado',[0,1])->default(1);

            $table->foreign('persona_id')->references('id')->on('personas');

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
        Schema::dropIfExists('sexos');
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('personas');
        Schema::dropIfExists('personasjuridicas');
        Schema::dropIfExists('users');
    }
}
