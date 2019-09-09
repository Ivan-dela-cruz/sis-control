<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {

            $table->increments('id');
            //campo id_p almacenara la clave primaria de la tabla users,
            //relacion de one to one
            $table->integer('id_p')->unsigned();
            $table->string('serie_e');
            $table->string('marca_e',180);
            $table->string('modelo_t',180);
            $table->string('tipo_t');
            $table->boolean('estado_e')->default(true);
            $table->text('descripcion_e');
            $table->timestamps();

            //relacion del campo id_p con la clave primaria id de la tabla users
            $table->foreign('id_p')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
