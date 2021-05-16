<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadtemasE extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actividadtemas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('semana_id')->after('curso_id'); 
            $table->foreign('semana_id')->references('idSemanas')->on('semanas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actividadtemas', function (Blueprint $table) {
            //$table->dropColumn('semana_id'); 
            //$table->foreign('semana_id')->references('idSemanas')->on('semanas');
        });
    }
}
