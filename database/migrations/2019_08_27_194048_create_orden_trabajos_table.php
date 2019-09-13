<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
            $table->increments('id');
            // las ordenes perteneceran a un solo usaurio con el rol del cliente sin embargo un cliente
            //podra tener varias ordenes de trabajo

            $table->integer('id_cli')->unsigned();
            $table->integer('id_tec')->unsigned()->nullable();
            $table->integer('codigo_or')->unsigned();
            $table->date('fecha_salida_or');
            $table->text('observacion_problema_or');
            $table->text('observacion_solucion_or')->nullable();
            $table->integer('etapa_servicio_or')->default('1');
            $table->integer('estado_or')->default('0');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // relaciona la orden d trabajo con el usaurio con rol de cliente
            $table->foreign('id_cli')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_trabajos');
    }
}
