<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cursos;
use App\Models\Alumnos;

class AlumnosAllCursos extends Component
{
    public $cursos;
    
    public function render()
    {
        $this->getAllCursosAlumno();
        return view('livewire.alumnos.alumnos-all-cursos');
    }

    public function getAllCursosAlumno(){
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

        $this->cursos = DB::table('curso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->join('periodo', 'curso.periodo_id', '=', 'periodo.idPeriodo')
        ->where('materias.academia', $idAlumno->carrera)
        ->where('periodo.periodo', $periodo)
        ->where('periodo.year', $year)
        ->select('curso.*','periodo.*','materias.academia')
        ->get();
    }
}
