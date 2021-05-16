<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Temas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->id('idTema');
            $table->enum('tipo', ['1', '2']); 
            $table->string('indice', 10);
            $table->string('nombreTema', 120);
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('idMateria')->on('materias');
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
        Schema::dropIfExists('temas');
    }
}
