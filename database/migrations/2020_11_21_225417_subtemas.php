<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subtemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('subtemas', function (Blueprint $table) {
            $table->id('idSubtema');
            $table->string('subindice', 10);
            $table->string('nombre_subindice',100);
            $table->unsignedBigInteger('tema_id');
            $table->foreign('tema_id')->references('idTema')->on('temas');
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
        //Schema::dropIfExists('subtemas');
    }
}
