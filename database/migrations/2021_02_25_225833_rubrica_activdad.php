<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RubricaActivdad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubricaActividad', function (Blueprint $table) {
            $table->id('idRubricaActividad');
            $table->string('criterio', 50);
            $table->string('descripcion', 200);
            $table->integer('puntuacion');
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')->references('idActividadTemas')->on('actividadtemas');
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
        Schema::dropIfExists('rubricaActividad');
    }
}
