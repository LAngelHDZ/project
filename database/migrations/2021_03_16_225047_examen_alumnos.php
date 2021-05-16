<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamenAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_alumno', function (Blueprint $table) {
            $table->id('idExamenAlumno');
            $table->unsignedBigInteger('examen_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('alumno_ca_id');
            $table->string('respuestas');
            $table->foreign('examen_id')->references('idExamen')->on('examencurso');
            $table->foreign('pregunta_id')->references('idPregunta')->on('preguntas_examen');
            $table->foreign('alumno_ca_id')->references('idCA')->on('carga_academica');
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
        Schema::dropIfExists('examen_alumno');
    }
}
