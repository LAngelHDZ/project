<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AlumnosInscritos extends Component
{
    public $alumnos, $idCurso;

    public function render()
    {
        $this->getAlumnos(); 
        return view('livewire.docentes.alumnos-inscritos');
    }


    public function getAlumnos(){
        
        $this->alumnos = DB::table('alumnos')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->join('carga_academica', 'alumnos.idAlumno', '=', 'carga_academica.alumno_id') 
        ->where('carga_academica.curso_id',$this->idCurso)
        ->select('users.name', 'users.lastname','alumnos.idAlumno', 'alumnos.nControl', 'alumnos.carrera','alumnos.semestre','users.email','carga_academica.status')
        ->get();
    } 
}
