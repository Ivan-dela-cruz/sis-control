<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            //campo id almacenara la clave primaria de la tabla users,
            //relacion de one to one
            $table->integer('id')->unsigned();
            $table->string('especialidad_t');
            $table->string('profesion_t');
            $table->boolean('tipo_t');
            $table->timestamps();

            //relacion del campo id con la clave primaria id de la tabla users
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tecnicos');
    }
}
