<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cursos;
use App\Models\Alumnos;

class AlumnosCursosInsc extends Component
{
    // controlador del componente de cursos inscritos del alumnos del periodo actual
    public $periodoCurso='', $yearCurso = '', $cursos;
    public $cursosActules = true, $allCursos = false; 

    public function render()
    {
        $this->getCursosActuales();
        return view('livewire.alumnos.alumnos-cursos-insc');
    }

    public function getCursosActuales(){
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

        $this->cursos = DB::table('carga_academica')
        ->join('curso', 'carga_academica.curso_id', '=', 'curso.idCurso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('periodo','curso.periodo_id','=','periodo.idPeriodo')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->where('periodo.periodo', $periodo)
        ->where('periodo.year', $year)
        ->where('carga_academica.alumno_id', $idAlumno->idAlumno)
        ->where('carga_academica.status', 1)
        //->select('curso.nombreCurso','curso.descripcion','periodo.periodo','periodo.year')
        ->select('curso.*','materias.academia','periodo.*')       
        ->get();
    }

    public function getAllCursos(){
        $idAlumno = Alumnos::where('user_id', Auth::user()->id )->first();

        $this->cursos = DB::table('carga_academica')
        ->join('curso', 'carga_academica.curso_id', '=', 'curso.idCurso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('periodo','curso.periodo_id','=','periodo.idPeriodo')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->where('carga_academica.alumno_id', $idAlumno->idAlumno)
        ->where('carga_academica.status', 1)
        //->select('curso.nombreCurso','curso.descripcion','periodo.periodo','periodo.year')
        ->select('curso.*','materias.academia','periodo.*')       
        ->get();
    }

    public function methodCursosActules(){
        $this->cursosActules = true;
        $this->allCursos = false;

        $this->getCursosActuales(); 
    }

    public function methodAllCursos(){
        $this->cursosActules = false;
        $this->allCursos = true;

        $this->getAllCursos();
    }
}
