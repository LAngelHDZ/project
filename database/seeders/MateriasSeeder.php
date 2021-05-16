<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('materias')->insert([
            'nombreMateria' => 'Fundamentos de Programacion',
            'semestre' => '1',
            'claveMateria' => 'FUNDAMENTOS',
            'academia' => 'ISC'
        ]);

        DB::table('materias')->insert([
            'nombreMateria' => 'Programacion Orientada a Objetos',
            'semestre' => '2',
            'claveMateria' => 'POO',
            'academia' => 'ISC'
        ]);

        DB::table('materias')->insert([
            'nombreMateria' => 'Estructura de datos',
            'semestre' => '3',
            'claveMateria' => 'EST',
            'academia' => 'ISC'
        ]);

        DB::table('materias')->insert([
            'nombreMateria' => 'Topicos Avanzados de Programacion',
            'semestre' => '4',
            'claveMateria' => 'TAP',
            'academia' => 'ISC'
        ]);
    }
}
