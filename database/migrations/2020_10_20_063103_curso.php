<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Curso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->id('idCurso');
            $table->string('nombreCurso', 50);
            $table->string('descripcion', 100);
            $table->string('acercadelcurso', 100); 
            $table->string('horario', 50);
            $table->string('aula', 10); 
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('periodo_id');
            $table->foreign('docente_id')->references('idDocente')->on('docente');
            $table->foreign('materia_id')->references('idMateria')->on('materias');
            $table->foreign('periodo_id')->references('idPeriodo')->on('periodo');
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
        Schema::dropIfExists('curso');
    }
}
