<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preguntasexamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_examen', function (Blueprint $table) {
            $table->id('idPregunta');
            $table->string('pregunta',100);
            $table->integer('tipo');
            $table->integer('puntos');
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('idExamen')->on('examenCurso');  
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
        Schema::dropIfExists('preguntas_examen');
    }
}
