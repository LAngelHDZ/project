<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Docente;


class Miscursos extends Component
{
    public $cursosActuales = true, $allCursos = false;
    public $cursos, $cursosall ,$contCursos =0, $conAllCursos=0;

    public function render()
    {
        $this->getCursosActuales();
        return view('livewire.docentes.miscursos');
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

    public function getAllCursos(){
        $idDocente = Docente::where('user_id', Auth::user()->id )->first();

        $this->cursosall = DB::table('curso')
        ->join('periodo','curso.periodo_id','=','idPeriodo')
        ->join('materias', 'curso.materia_id', '=', 'idMateria')
        ->where('docente_id',$idDocente->idDocente)
        ->select('curso.*', 'materias.academia')
        ->get();
        //->paginate(9);
    }

    public function methodCursosActuales(){
        $this->cursosActuales = true;
        $this->allCursos = false;

        $this->getCursosActuales();
    }

    public function methodAllCursos(){
        $this->cursosActuales = false;
        $this->allCursos = true;

        $this->getAllCursos();
    }
}
