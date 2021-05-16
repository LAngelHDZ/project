<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Models\Actividades;

class ActividadTema extends Component
{
    public $actividadTema, $cursoid, $examenCurso;

    public function render()
    {
        $this->getActividadTema();
        $this->getExamen();
        return view('livewire.alumnos.actividad-tema');
    }

    public function getActividadTema(){
        /*$this->actividadTema = DB::table('temas')
        ->join('actividadtemas', 'temas.idTema','=','actividadtemas.temas_id')
        ->where('actividadtemas.curso_id', $this->cursoid)
        ->select('temas.*', 'actividadtemas.*')
        ->get();*/

        $this->actividadTema = DB::table('actividadtemas')
        ->join('semanas', 'actividadtemas.semana_id', '=', 'semanas.idSemanas')
        ->join('temas','actividadtemas.temas_id','=','temas.idTema')
        ->leftJoin('actividades_alumnos', 'actividadtemas.idActividadTemas','=','actividades_alumnos.actividad_id')
        ->where('actividadtemas.curso_id', $this->cursoid)
        ->select('actividadtemas.*','temas.nombreTema','temas.tipo','temas.indice','semanas.finicio','semanas.ffinal',DB::raw('case when actividades_alumnos.actividad_id IS NULL then 0 ELSE 1 END AS actEntregada'))
        //->orderBy('actividadtemas.fechainicio')
        ->groupBy('actividadtemas.semana_id', 'actividadtemas.idActividadTemas')
        //->having('actividadtemas.fechainicio', '=', '2021-01-18')
        ->get();
    }

    public function getExamen(){
        $this->examenCurso = DB::table('examencurso')
        ->where('examencurso.curso_id', $this->cursoid)
        ->select('examencurso.*')
        ->get(); 
    }

    public function verificarExamen($idExamen){

        $verificar = DB::table('examen_alumno')
        ->select('examen_alumno.*')
        ->where('examen_alumno.examen_id', $idExamen)
        ->count();

        return $verificar;
    }

}
