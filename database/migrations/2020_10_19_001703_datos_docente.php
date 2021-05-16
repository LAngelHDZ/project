<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosDocente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_docente', function (Blueprint $table) {
            $table->unsignedBigInteger('docente_id');
            $table->string('lugarNac',50);
            $table->date('fechaNac');
            $table->enum('genero',['masculino','femenino']);
            $table->string('estado_civil',50);
            $table->string('direccion',50);
            $table->string('colonia',50);
            $table->string('ciudad',50);
            $table->string('telefono',15);
            $table->string('cp',20);
            $table->string('curp',20);
            $table->string('num_seguro',20);
            $table->string('tipo_sangre',10);
            $table->string('alergias',50);
            $table->string('medicamentos_alergicos',50);
            $table->string('complicaciones_medicas',50);
            $table->string('contacto_emerg',50);
            $table->string('tel_contacto',15);
            $table->string('parentesco',50);
            $table->string('contacto_emerg2',50);
            $table->string('tel_contacto2',15);
            $table->string('parentesco2', 50);
            $table->foreign('docente_id')->references('idDocente')->on('docente'); 
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
        Schema::dropIfExists('datos_docente');
    }
}
