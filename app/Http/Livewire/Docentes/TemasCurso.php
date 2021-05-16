<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Temas;

class TemasCurso extends Component
{
    public $idMateria;
    public $idCurso;
    public $temas;

    public function render()
    {
        $this->getTemas(); 
        return view('livewire.docentes.temas-curso');
    }

    public function getTemas(){
        //$this->temas = Temas::where('materia_id', $this->idMateria)->get();

        //$select = 'SELECT temas.idTema,actividadtemas.idActividadTemas, CASE WHEN actividadtemas.temas_id IS NULL THEN 0 ELSE 1 END AS cantAct  FROM temas LEFT JOIN actividadtemas ON temas.idTema = actividadtemas.idActividadTemas WHERE temas.materia_id = ?';

        //$this->temas = DB::selectRaw($select,[$this->idMateria]);
        $this->temas = DB::table('temas')
        ->leftJoin('actividadtemas', 'temas.idTema', '=', 'actividadtemas.temas_id')
        ->where('temas.materia_id', $this->idMateria)
        ->select('temas.*','actividadtemas.idActividadTemas',DB::raw('case when actividadtemas.temas_id IS NULL then 0 ELSE 1 END AS cantAct'))
        ->orderBy('temas.indice', 'asc')
        ->get();
    }
}
