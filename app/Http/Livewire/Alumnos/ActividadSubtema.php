<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ActividadSubtema extends Component
{
    public $cursoid, $actividadSubtemas;
    public function render()
    {
        $this->getActividadSubtema();
        return view('livewire.alumnos.actividad-subtema');
    }

    public function getActividadSubtema(){

        $this->actividadSubtemas = DB::table('subtemas')
        ->join('actividadsubtemas', 'subtemas.idSubtema', '=', 'actividadsubtemas.subtemas_id')
        ->where('actividadsubtemas.curso_id', $this->cursoid)
        ->select('subtemas.*', 'actividadsubtemas.*')
        ->get();
    }
}
