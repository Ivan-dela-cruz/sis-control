<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicoOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnico_orden_trabajos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_tec')->unsigned();
            $table->integer('id_or')->unsigned();
            //relacion del campo id_e con la clave primaria id de la tabla equipos
            $table->foreign('id_tec')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //relacion del campo id_c con la clave primaria id de la tabla users
            $table->foreign('id_or')->references('id')->on('orden_trabajos')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('tecnico_orden_trabajos');
    }
}
