<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Docente;
use App\Models\Cursos;
use Livewire\WithPagination;

class CursosDocente extends Component
{
    use WithPagination;
    //public $cursos;
    public $cursos;

    public function render()
    {
        $this->getCursosActuales();
        return view('livewire.cursos-docente');
    }

    public function getCursosActuales(){
        $idDocente = Docente::where('user_id', Auth::user()->id )->first();

        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }

        $this->contCursos = DB::table('curso')
        ->join('periodo','curso.periodo_id','=','idPeriodo')
        ->join('materias', 'curso.materia_id', '=', 'idMateria')
        ->where('docente_id',$idDocente->idDocente)
        ->where('periodo.year', $year)
        ->where('periodo.periodo', $periodo)
        ->count();
        
        $this->cursos = DB::table('curso')
        ->join('periodo','curso.periodo_id','=','idPeriodo')
        ->join('materias', 'curso.materia_id', '=', 'idMateria')
        ->where('docente_id',$idDocente->idDocente)
        ->where('periodo.year', $year)
        ->where('periodo.periodo', $periodo)
        ->select('curso.*', 'materias.academia')
        ->get();
    }
}
