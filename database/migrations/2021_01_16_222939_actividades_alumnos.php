<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadesAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_alumnos', function (Blueprint $table) {
            $table->id('idActividadAlumno');
            $table->string('archivo',200);
            $table->date('fechaEntrega');
            $table->time('hora');
            $table->unsignedBigInteger('actividad_id');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('actividad_id')->references('idActividadTemas')->on('actividadtemas'); 
            $table->foreign('alumno_id')->references('idAlumno')->on('alumnos');
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
        Schema::dropIfExists('actividades_alumnos');
    }
}
