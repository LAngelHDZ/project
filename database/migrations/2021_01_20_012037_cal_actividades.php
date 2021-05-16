<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cal_actividades', function (Blueprint $table) {
            $table->id('idCalActividad');
            $table->integer('calificacion');
            $table->string('comentarios', 100); 
            $table->unsignedBigInteger('tarea_id');
            $table->foreign('tarea_id')->references('idActividadAlumno')->on('actividades_alumnos'); 
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
        Schema::dropIfExists('cal_actividades');
    }
}
