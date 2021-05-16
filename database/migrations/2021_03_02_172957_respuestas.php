<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Respuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_preguntas', function (Blueprint $table) {
            $table->id('idRespuesta');
            $table->string('respuesta',100);
            $table->integer('rcorrecta');
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('idPregunta')->on('preguntas_examen'); 
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
        Schema::dropIfExists('respuetas_preguntas');
    }
}
