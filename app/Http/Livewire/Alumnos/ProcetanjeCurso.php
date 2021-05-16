<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumnos;

class ProcetanjeCurso extends Component
{
    public $porcentaje=0, $cursoId;

    public function render()
    {
        $this->getPorcentaje();
        return view('livewire.alumnos.procetanje-curso');
    }

    public function getPorcentaje(){
        $id = Auth::id();
        $idAlumno = Alumnos::where('user_id', $id)->first();

        $total = DB::table('actividades_alumnos')
        ->join('actividadtemas', 'actividades_alumnos.actividad_id', '=', 'actividadtemas.idActividadTemas')
        ->select('actividadtemas.porcentajeCurso')
        ->where('actividadtemas.curso_id', $this->cursoId)
        ->where('actividades_alumnos.alumno_id', $idAlumno->idAlumno)
        ->get();

        foreach ($total as $value) {
            # code...
            $this->porcentaje = $this->porcentaje + $value->porcentajeCurso;
        }
    }
}
