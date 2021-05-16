<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actividadtemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadtemas', function (Blueprint $table) {
            $table->id('idActividadTemas');
            $table->string('nombreActividad',50);
            $table->string('descripcionActividad', 200); 
            $table->string('recursos', 100);
            $table->integer('tipoActividad'); //1 = actividad Normal, 2 = practica
            //$table->integer('puntuacion');
            $table->date('fechainicio');
            $table->date('fechalimite');
            $table->integer('porcentajeCurso');
            $table->unsignedBigInteger('temas_id');
            $table->unsignedBigInteger('curso_id');
            //$table->unsignedBigInteger('semana_id'); 
            $table->foreign('temas_id')->references('idTema')->on('temas');
            $table->foreign('curso_id')->references('idCurso')->on('curso');
            //$table->foreign('semana_id')->references('idSemanas')->on('semanas'); 
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
        Schema::dropIfExists('actividadtemas');
    }
}
