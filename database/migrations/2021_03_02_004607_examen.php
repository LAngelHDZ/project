<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Examen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenCurso', function (Blueprint $table) {
            $table->id('idExamen');
            $table->string('titulo');
            $table->string('descripcion');
            $table->date('fecha_apertura');
            $table->time('hora_apertura', $precision = 0);
            $table->date('fechalimite');
            $table->time('horalimite', $precision = 0);
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('idCurso')->on('curso');
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
        Schema::dropIfExists('examenCurso');
    }
}
