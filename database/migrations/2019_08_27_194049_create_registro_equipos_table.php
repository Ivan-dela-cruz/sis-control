<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_equipos', function (Blueprint $table) {
            $table->increments('id');
            //campo id_e almacenara la clave primaria de la tabla equipos,
            //relacion de one to one
            $table->integer('id_e')->unsigned();
            //campo id_c almacenara la clave primaria de la tabla ordenes de trabajo
            $table->integer('id_or')->unsigned();
            $table->Text('problema_re');
            $table->date('fecha_salida_re');
            $table->text('accesorios_re');
            $table->timestamps();


            //relacion del campo id_e con la clave primaria id de la tabla equipos
            $table->foreign('id_e')->references('id')->on('equipos')->onDelete('cascade')->onUpdate('cascade');
            //relacion del campo id_c con la clave primaria id de la tabla users
            $table->foreign('id_or')->references('id')->on('orden_trabajos')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_equipos');
    }
}
