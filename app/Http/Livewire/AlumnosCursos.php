<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cursos;
use App\Models\Alumnos;

class AlumnosCursos extends Component
{
    public $cursosInscritos;

    public function render()
    {
        $idAlumno = Alumnos::where('user_id', Auth::user()->id )->first();

        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }

        $cursos = DB::table('curso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->join('periodo', 'curso.periodo_id', '=', 'periodo.idPeriodo')
        ->where('materias.academia', $idAlumno->carrera)
        ->where('periodo.periodo', $periodo)
        ->where('periodo.year', $year)
        ->select('curso.*','periodo.*','materias.academia')
        ->paginate(9);

        $this->getCursosInscritos(); 

        return view('livewire.alumnos-cursos')->with(compact('cursos'));
    }

    public function getCursosInscritos(){
        $idAlumno = Alumnos::where('user_id', Auth::user()->id )->first();

        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }

        $this->cursosInscritos = DB::table('carga_academica')
        ->join('curso', 'carga_academica.curso_id', '=', 'curso.idCurso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('periodo','curso.periodo_id','=','periodo.idPeriodo')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->where('periodo.periodo', $periodo)
        ->where('periodo.year', $year)
        ->where('carga_academica.alumno_id', $idAlumno->idAlumno)
        ->where('carga_academica.status', 1)
        //->select('curso.nombreCurso','curso.descripcion','periodo.periodo','periodo.year')
        ->select('curso.*','periodo.*','materias.academia')     
        ->get();

    }
}
