<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalificacionParcial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacionParcial', function (Blueprint $table) {
            $table->id('idCalparcial');
            $table->integer('calificacion');
            $table->unsignedBigInteger('unidad_id'); 
            $table->unsignedBigInteger('alumno_ins_id');
            $table->foreign('unidad_id')->references('idTema')->on('temas');
            $table->foreign('alumno_ins_id')->references('idCA')->on('carga_academica');
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
        Schema::dropIfExists('calificacionParcial');
    }
}
