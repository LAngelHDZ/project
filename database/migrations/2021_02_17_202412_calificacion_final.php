<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalificacionFinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacionFinal', function (Blueprint $table) {
            $table->id('idCalFinal');
            $table->integer('calificacion');
            $table->unsignedBigInteger('alumno_ins_id');
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
        Schema::dropIfExists('calificacionFinal');
    }
}
