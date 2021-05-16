<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Temas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('temas')->insert([
            'tipo' => '1',
            'indice' => '1',
            'nombreTema' => 'Diseño Algoritmico',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '1.1',
            'nombreTema' => 'Conceptos Basicos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '1.2',
            'nombreTema' => 'Representacion de Algoritmos: Grafica y Pseudocodigo',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '1.3',
            'nombreTema' => 'Diseño de Algoritmos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '1.4',
            'nombreTema' => 'Diseño de Funciones',
            'materia_id' => 1,
        ]);


        DB::table('temas')->insert([
            'tipo' => '1',
            'indice' => '2',
            'nombreTema' => 'Introduccion a la Programacion',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '2.1',
            'nombreTema' => 'Conceptos Basicos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '2.2',
            'nombreTema' => 'Caracteristicas del Lenguaje de Programacion',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '2.3',
            'nombreTema' => 'Estructuras Basicas de un Programa',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '2.4',
            'nombreTema' => 'Elementos del Lenguaje: tipos de datos, literales, constantes, variables, identificadores',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '2.5',
            'nombreTema' => 'Traducción de un programa: compilación, enlace, ejecución y errores',
            'materia_id' => 1,
        ]);

        
        DB::table('temas')->insert([
            'tipo' => '1',
            'indice' => '3',
            'nombreTema' => 'Control de Flujo',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '3.1',
            'nombreTema' => 'Estructuras Secuenciales',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '3.2',
            'nombreTema' => 'Estructuras Selectivas: simples, dobles, multiples',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '3.3',
            'nombreTema' => 'Estructuras iterativas: repetir mientras, hasta, desde',
            'materia_id' => 1,
        ]);


        DB::table('temas')->insert([
            'tipo' => '1',
            'indice' => '4',
            'nombreTema' => 'Organizacion de Datos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '4.1',
            'nombreTema' => 'Arreglos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '4.2',
            'nombreTema' => 'Unidimencionales',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '4.3',
            'nombreTema' => 'Multidimencionales',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo'=> '2',
            'indice' => '4.4',
            'nombreTema' => 'Estructuras o registros',
            'materia_id' => 1,
        ]);


        DB::table('temas')->insert([
            'tipo' => '1',
            'indice' => '5',
            'nombreTema' => 'Modularidad',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '5.1',
            'nombreTema' => 'Declaracion y uso de modulos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '5.2',
            'nombreTema' => 'Paso de parametros o argumentos',
            'materia_id' => 1,
        ]);
        DB::table('temas')->insert([
            'tipo' => '2',
            'indice' => '5.3',
            'nombreTema' => 'Implementacion',
            'materia_id' => 1,
        ]);
    }
}
