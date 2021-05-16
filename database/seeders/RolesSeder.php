<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $docente = Role::create(['name' => 'Docente']);

        $docente->givePermissionTo([
            'datos_docentes.index',
            'datos_docentes.store',
            'datos_docentes.update'
        ]);

        $alumno = Role::create(['name' => 'Alumno']);

        $alumno->givePermissionTo([
            'datos_alumnos.index',
            'datos_alumnos.store',
            'datos_alumnos.update',
            'cursos_alumnos.show',
            'cursos_alumnos.index',
            'tareas_alumnos.index',
            'tareas_alumnos.show',
            'tareas_alumnos.store',
            'tereas_alumnos.update'
        ]);
    }
}
