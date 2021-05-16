<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('alumno_id');
            $table->string('lugarNac',50);
            $table->date('fechaNac');
            $table->enum('genero',['masculino','femenino']);
            $table->string('estado_civil',50);
            $table->string('direccion',50);
            $table->string('colonia',50);
            $table->string('ciudad',50);
            $table->string('cp',10);
            $table->string('telefono',10);
            $table->string('curp',25);
            $table->string('num_seguro',15);
            $table->enum('tipo_sangre',['O+','O-','A+','A-','B+','B-','AB+','AB-']);
            $table->string('alergias');
            $table->string('medicamentos_alergicos');
            $table->string('complicaciones_medicas');
            $table->string('nom_madre',100);
            $table->string('direccion_madre',50);
            $table->string('colonia_madre',50);
            $table->string('tel_madre',10);
            $table->string('nom_padre',100);
            $table->string('direccion_padre',50);
            $table->string('colonia_padre',50);
            $table->string('tel_padre',10);
            $table->string('contacto_emergencia',50);
            $table->string('tel_contacto',15);
            $table->string('parentesco',50);
            $table->string('contacto_emergencia2',50);
            $table->string('tel_contacto2',15);
            $table->string('parentesco2',50);    
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
        Schema::dropIfExists('datos_alumnos');
    }
}
