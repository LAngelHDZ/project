<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\semana;
use App\Models\Actividades;


class ActividadSemanas extends Component
{
    public $idperiodo;
    public $idcurso;
    public $semanas;
    public $actividades;
    public function render()
    {
        
        $this->showsemanas();
        return view('livewire.actividad-semanas');
    }

     public function showsemanas(){
        $this->actividades = Actividades::join('semanas','actividadtemas.semana_id','=','semanas.idSemanas')
        ->select('actividadtemas.idActividadTemas','actividadtemas.semana_id','actividadtemas.nombreActividad','actividadtemas.descripcionActividad')
        ->where('semanas.periodo_id',$this->idperiodo)->get();
        $this->semanas = semana::where('periodo_id',$this->idperiodo)->get();
     }
}
