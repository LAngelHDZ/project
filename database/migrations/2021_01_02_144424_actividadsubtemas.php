<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actividadsubtemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('actividadsubtemas', function (Blueprint $table) {
            $table->id('idActividadSubtemas');
            $table->string('nombreActividad',50);
            $table->string('descripcionActividad', 100);
            $table->string('recursos',100);
            $table->date('fechainicio');
            $table->date('fechalimite');
            $table->unsignedBigInteger('subtemas_id');
            $table->unsignedBigInteger('curso_id');
            $table->foreign('subtemas_id')->references('idSubtema')->on('subtemas');
            $table->foreign('curso_id')->references('idCurso')->on('curso');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('actividadsubtemas');
    }
}
