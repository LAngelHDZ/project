<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RespuestasExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_alumno', function (Blueprint $table) {
            $table->id('idResAlumno');
            $table->unsignedBigInteger('examen_alumno_id');
            $table->integer('rcorrecta');
            $table->foreign('examen_alumno_id')->references('idExamenAlumno')->on('examen_alumno');
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
        Schema::dropIfExists('respuetas_alumno');
    }
}
