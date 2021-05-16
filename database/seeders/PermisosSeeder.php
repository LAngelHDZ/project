<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permisos = [
            //docentes
            'datos_docentes.index',
            'datos_docentes.store',
            'datos_docentes.update',
            'cursos_docente.index',
            'cursos_docente.show',
            'cursos_docente.create',
            //alumnos
            'datos_alumnos.index',
            'datos_alumnos.store',
            'datos_alumnos.update',
            'cursos_alumnos.show',
            'cursos_alumnos.index',
            'cursos_alumnos.create',
            'tareas_alumnos.index',
            'tareas_alumnos.show',
            'tareas_alumnos.store',
            'tereas_alumnos.update',
            //todavia no se
            'user.update',
            'materia.update',
            'curso.update'
        ];

        foreach ($permisos as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
