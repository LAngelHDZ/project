<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Subtemas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subtemas')->insert([
            'subindice' => '1.1',
            'nombre_subindice' => 'Conceptos Basicos',
            'tema_id' => 1,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '1.2',
            'nombre_subindice' => 'Representacion de Algoritmos: Grafica y Pseudocodigo',
            'tema_id' => 1,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '1.3',
            'nombre_subindice' => 'Diseño de Algoritmos',
            'tema_id' => 1,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '1.4',
            'nombre_subindice' => 'Diseño de Funciones',
            'tema_id' => 1,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '2.1',
            'nombre_subindice' => 'Conceptos Basicos',
            'tema_id' => 2,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '2.2',
            'nombre_subindice' => 'Caracteristicas del Lenguaje de Programacion',
            'tema_id' => 2,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '2.3',
            'nombre_subindice' => 'Estructuras Basicas de un Programa',
            'tema_id' => 2,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '2.4',
            'nombre_subindice' => 'Elementos del Lenguaje: tipos de datos, literales, constantes, variables, identificadores',
            'tema_id' => 2,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '2.5',
            'nombre_subindice' => 'Traducción de un programa: compilación, enlace, ejecución y errores',
            'tema_id' => 2,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '3.1',
            'nombre_subindice' => 'Estructuras Secuenciales',
            'tema_id' => 3,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '3.2',
            'nombre_subindice' => 'Estructuras Selectivas: simples, dobles, multiples',
            'tema_id' => 3,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '3.3',
            'nombre_subindice' => 'Estructuras iterativas: repetir mientras, hasta, desde',
            'tema_id' => 3,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '4.1',
            'nombre_subindice' => 'Arreglos',
            'tema_id' => 4,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '4.2',
            'nombre_subindice' => 'Unidimencionales',
            'tema_id' => 4,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '4.3',
            'nombre_subindice' => 'Multidimencionales',
            'tema_id' => 4,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '4.4',
            'nombre_subindice' => 'Estructuras o registros',
            'tema_id' => 4,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '5.1',
            'nombre_subindice' => 'Declaracion y uso de modulos',
            'tema_id' => 5,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '5.2',
            'nombre_subindice' => 'Paso de parametros o argumentos',
            'tema_id' => 5,
        ]);

        DB::table('subtemas')->insert([
            'subindice' => '5.3',
            'nombre_subindice' => 'Implementacion',
            'tema_id' => 5,
        ]);
    }
}
